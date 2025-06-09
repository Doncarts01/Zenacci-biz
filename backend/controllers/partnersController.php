<?php
require_once(__DIR__ . "/../config/init.php");

class Partners extends Db_object
{
    protected static $table = 'partners';
    protected static $fillable = ['image', 'url','created_at', 'updated_at'];

    public $id;
    public $image;
    public $url;
    public $created_at;
    public $updated_at;

    public $filename;
    public $tmp_path;
    public $upload_dir = "uploads" . DS . "partners";
    public $upload_placeholder = 'uploads' . DS . 'no_image.jpg';


    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function save()
    {
        $this->updated_at = date('Y-m-d H:i:s');
        return parent::save();
    }
}
