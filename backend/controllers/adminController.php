<?php 
require_once(__DIR__ . "/../config/init.php");

class Admin extends Db_object {
    protected static $table = 'admin'; 
    protected static $fillable = ['username', 'email', 'password', 'created_at', 'updated_at']; 

    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s'); 
        $this->updated_at = date('Y-m-d H:i:s'); 
    } 

    public function save() {
        $this->updated_at = date('Y-m-d H:i:s'); 
        return parent::save(); 
    }
}
