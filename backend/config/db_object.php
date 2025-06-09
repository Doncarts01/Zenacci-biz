<?php
require_once("collection.php");

class Db_object
{
    protected static $table = '';
    public $id = '';
    protected static $fillable = [];

    // File Upload Properties
    public $image;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_dir = "uploads";  // Default directory
    public $upload_placeholder = 'uploads' . DS . 'no_image.png';
    public $errors = [];
    public $upload_errors_array = [
        UPLOAD_ERR_OK => "No errors",
        UPLOAD_ERR_INI_SIZE => "File too large",
        UPLOAD_ERR_FORM_SIZE => "Form size exceeded",
        UPLOAD_ERR_PARTIAL => "Partial upload",
        UPLOAD_ERR_NO_FILE => "No file",
        UPLOAD_ERR_NO_TMP_DIR => "No temp directory",
        UPLOAD_ERR_CANT_WRITE => "Can't write",
        UPLOAD_ERR_EXTENSION => "Stopped by extension"
    ];

    // Core Database Methods
    public static function all()
    {
        return new Collection(static::findThisQuery("SELECT * FROM " . static::$table));
    }

    public static function latest()
    {
        return new Collection(static::findThisQuery("SELECT * FROM " . static::$table . " ORDER BY id DESC"));
    }

    public static function findOrFail($id)
    {
        global $database;
    if (!$database->connection) {
        error_log("Database connection is not valid in findOrFail.");
        return false;
    }
    if ($id === null) {
        throw new Exception("ID cannot be null");
    }
        $result_array = static::findThisQuery("SELECT * FROM " . static::$table . " WHERE id = $id LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function run_query($sql) {
        global $database;
        if (!$database->connection) {
            error_log("Database connection is not valid in run_query.");
            return false;
        }
        $result_set = $database->query($sql);
        if(!$result_set){
            error_log("Database query failed: " . $database->connection->error);
            return false;
        }
        return $result_set;
    }


    public static function run_Thisquery($sql, $params = [])
{
    global $database;

    $stmt = $database->connection->prepare($sql);
    if (!$stmt) {
        throw new Exception("SQL error: " . $database->connection->error);
    }

    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assume all params are strings
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result;
}

    protected static function findThisQuery($sql) {
        global $database;
        if (!$database->connection) {
            error_log("Database connection is not valid in findThisQuery.");
            return [];
        }
        $result_set = $database->query($sql);
        if(!$result_set){
            error_log("Database query failed: " . $database->connection->error);
            return [];
        }
        $the_object_array = [];
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    private static function instantiation($record)
    {
        $called_class = get_called_class();
        $object = new $called_class;
        foreach ($record as $attribute => $value) {
            if ($object->has_the_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_the_attribute($attribute)
    {
        return property_exists($this, $attribute);
    }


    // Database Operations
    protected function properties()
    {
        $properties = [];
        foreach (static::$fillable as $field) {
            if (property_exists($this, $field)) {
                $properties[$field] = $this->$field;
            }
        }
        return $properties;
    }

    // protected function clean_properties()
    // {
    //     global $database;
    //     $clean_props = [];
    //     foreach ($this->properties() as $key => $value) {
    //         $clean_props[$key] = $database->escape_string($value);
    //     }
    //     return $clean_props;
    // }

    protected function clean_properties()
    {
        global $database;

        $clean_properties = [];

        foreach ($this->properties() as $key => $value) {
            if (is_object($value)) {
                // If the value is an object, use its ID or another unique identifier
                $clean_properties[$key] = $database->escape_string($value->id);
            } else {
                // Otherwise, escape the string value
                $clean_properties[$key] = $database->escape_string($value);
            }
        }

        return $clean_properties;
    }

    protected function create()
    {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$table . " (" . implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";


        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        }
        return false;
    }

    // protected function update()
    // {
    //     global $database;
    //     $properties = $this->clean_properties();
    //     $prop_pairs = [];

    //     foreach ($properties as $key => $value) {
    //         $prop_pairs[] = "{$key} = '{$value}'";
    //     }

    //     $sql = "UPDATE " . static::$table . " SET ";
    //     $sql .= implode(", ", $prop_pairs);
    //     $sql .= " WHERE id = " . $database->escape_string($this->id);

    //     $database->query($sql);
    //     return (mysqli_affected_rows($database->connection) == 1);
    // }


    protected function update()
    {
        global $database;

        // Get cleaned properties
        $properties = $this->clean_properties();
        if (empty($properties)) {
            $this->errors[] = "No properties to update.";
            return false;
        }

        // Build the SQL query
        $prop_pairs = [];
        foreach ($properties as $key => $value) {
            $prop_pairs[] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . static::$table . " SET ";
        $sql .= implode(", ", $prop_pairs);
        $sql .= " WHERE id = " . $database->escape_string($this->id);

        $result = $database->query($sql);

        // Check for MySQL errors
        if (!$result) {
            $this->errors[] = "Database Error: " . $database->connection->error;
            return false;
        }

        // Check if any rows were affected
        if (mysqli_affected_rows($database->connection) == 1) {
            return true;
        } else {
            $this->errors[] = "No rows were updated.";
            return false;
        }
    }




    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$table . " WHERE id = " . $database->escape_string($this->id) . "";
        return $database->query($sql);
    }

    /**
     * Delete records based on a condition.
     *
     * @param string $condition The SQL condition (e.g., "cart_id = 123")
     * @return bool
     */
    public static function deleteByCondition($condition)
    {
        global $database;
        $sql = "DELETE FROM " . static::$table . " WHERE " . $condition;
        return $database->query($sql);
    }

    // Additional Utilities
    public static function countAll()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table;
        $result = $database->query($sql);
        $row = mysqli_fetch_array($result);
        return array_shift($row);
    }

    public static function findByColumn($column, $value)
    {
        global $database;
        $column = $database->escape_string($column);
        $value = $database->escape_string($value);
        $sql = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}' LIMIT 1";
        $result = static::findThisQuery($sql);
        return !empty($result) ? array_shift($result) : false;
    }
    public static function findColumn($column, $value)
    {
        global $database;
        $column = $database->escape_string($column);
        $value = $database->escape_string($value);
        $sql = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";
        $result = static::findThisQuery($sql);
        return !empty($result) ? array_shift($result) : [];
        // return $result ?: []; 
    }

    public static function where($column, $operator, $value)
    {
        global $database;
        $column = $database->escape_string($column);
        $value = $database->escape_string($value);
        $sql = "SELECT * FROM " . static::$table . " WHERE {$column} {$operator} '{$value}'";
        return new Collection(static::findThisQuery($sql));
    }



    public function set_file($file)
    {
        if (empty($file) || !is_array($file)) {
            $this->errors[] = "No file uploaded";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $allowed_types = ['jpg', 'jpeg', 'png'];
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($file_ext, $allowed_types)) {
                $this->errors[] = "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
                return false;
            }

            $max_size = 5 * 1024 * 1024; // 1MB in bytes
            if ($file['size'] > $max_size) {
                $this->errors[] = "File size exceeds the limit of 1MB.";
                return false;
            }

            $this->filename = uniqid() . "." . $file_ext;
            $this->tmp_path = $file['tmp_name'];
            return true;
        }
    }

    public function save()
    {
        // Reset errors before each save attempt
        $this->errors = [];

        if (!empty($this->tmp_path)) {
            $target_path = UPLOADS . DS . $this->upload_dir . DS . $this->filename;

            if (!move_uploaded_file($this->tmp_path, $target_path)) {
                $this->errors[] = "File move failed: ";
                return false;
            }

            $this->image = $this->upload_dir . DS . $this->filename;
        }

        // Save to the database (no changes needed here either)
        if ($this->id) {
            if ($this->update()) {
                unset($this->tmp_path);
                return true;
            } else {
                $this->errors[] = "Failed to update record";
                return false;
            }
        } else {
            if ($this->create()) {
                unset($this->tmp_path);
                return true;
            } else {
                $this->errors[] = "Failed to create record";
                return false;
            }
        }
    }

    public function imageShow()
    {
        if (!empty($this->image)) {
            return SITE_ROOT . DS . $this->image;
        } else {
            return SITE_ROOT . DS . $this->upload_placeholder;
        }
    }

    public function count()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table;
        $result = $database->query($sql);
        $row = mysqli_fetch_array($result);
        return array_shift($row);
    }

    public static function findById($id)
{
    global $database;
    $id = $database->escape_string($id);

    $sql = "SELECT * FROM " . static::$table . " WHERE id = '{$id}' LIMIT 1";
    $result = static::findThisQuery($sql);

    return !empty($result) ? array_shift($result) : null;
}


    public static function deleteMany($id)
    {
        global $database;
        if (!empty($id)) {
            $idList = implode(',', array_map('intval', $id)); // Sanitize IDs
            $sql = "DELETE FROM " . self::$table . " WHERE order_id IN ($idList)";
            return $database->query($sql);
        }
        return false;
    }
}
