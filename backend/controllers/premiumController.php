<?php
require_once(__DIR__ . "/../config/init.php");

class Premium extends Db_object
{
    protected static $table = 'premium';
    protected static $fillable = ['full_name', 'email', 'phone', 'whatsapp', 'business_name', 'business_desc', 'sales_problem', 'objectives', 'barrier', 'industry', 'budget', 'timeline', 'decision_maker', 'notes', 'created_at', 'updated_at'];

    public $id;
    public $full_name;
    public $email;
    public $phone;
    public $whatsapp;
    public $business_name;
    public $business_desc;
    public $sales_problem;
    public $objectives;
    public $barrier;
    public $industry;
    public $budget;
    public $timeline;
    public $decision_maker;
    public $notes;
    public $created_at;
    public $updated_at;


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
