<?php 
require_once(__DIR__ . "/../config/init.php");

class Settings extends Db_object {
    protected static $table = 'settings'; 
    protected static $fillable = ['image', 'email', 'phone', 'text', 'description']; 

    public $id;
    public $image;
    public $email;
    public $phone;
    public $text;
    public $description;

    public $filename;
    public $tmp_path;
    public $upload_dir = "uploads" . DS . "settings";
    public $upload_placeholder = 'uploads' . DS . 'no_image.jpg';

}
