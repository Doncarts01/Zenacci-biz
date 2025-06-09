<?php 
require_once(__DIR__ . "/../config/init.php");

class Customers extends Db_object {
    protected static $table = 'customers'; 
    protected static $fillable = [ 'name','email', 'created_at']; 

    public $id;
    public $name;
    public $email;
    public $created_at;

    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s'); 
    } 

}
