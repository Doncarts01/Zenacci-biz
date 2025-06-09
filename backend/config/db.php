<?php 

class Database{

    private $host = "localhost";
    private $db_name = "zenadmgp_zenacci_db";
    private $username = "zenadmgp_zenacci_user";
    private $password = "n(SD8p{Dcq&@";
    public $connection;

    function __construct(){

        $this->open_db_connection();
    }


    public function open_db_connection(){
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if($this->connection->connect_errno){
            die("Error connecting". $this->connection->connect_error);
        }

        return $this->connection;
    }


    public function query($sql){
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }


    private function confirm_query($result){
        if(!$result){
            die("Error executing query". $this->connection->error);
        }
    }


    public function escape_string($string){
       $escaped_string = $this->connection->real_escape_string($string);
       return $escaped_string;
    }


    public function the_insert_id(){
        return $this->connection->insert_id;
    }

    public function close_connection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

}


$database = new Database();
global $db_connection; 
$db_connection = $database->connection; 
?>