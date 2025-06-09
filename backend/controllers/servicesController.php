<?php 
require_once(__DIR__ . "/../config/init.php");

class Services extends Db_object {
    protected static $table = 'services'; 
    protected static $fillable = ['image', 'title', 'tags', 'description', 'color', 'created_at','updated_at']; 

    public $id;
    public $image;
    public $title;
    public $tags;
    public $description;
    public $color;
    public $created_at;
    public $updated_at;

    public $filename;
    public $tmp_path;
    public $upload_dir = "uploads" . DS . "services";
    public $upload_placeholder = 'uploads' . DS . 'no_image.jpg';


    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s'); 
        $this->updated_at = date('Y-m-d H:i:s'); 
    } 

    public function save() {
        $this->updated_at = date('Y-m-d H:i:s'); 
        return parent::save(); 
    }
}
