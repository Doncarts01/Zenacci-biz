<?php 
require_once(__DIR__ . "/../config/init.php");

class Pricing extends Db_object {
    protected static $table = 'pricing'; 
    protected static $fillable = ['plan', 'price', 'duration', 'description','cta','is_form','url', 'created_at','updated_at']; 

    public $id;
    public $plan;
    public $price;
    public $duration;
    public $description;
    public $cta;
    public $is_form;
    public $url;
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
