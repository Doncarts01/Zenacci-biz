<?php
require_once("../config/init.php");


    if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){


        // var_dump($_POST);

        $full_name = $_POST['full_name'];
        $email = trim($_POST['email']);
        $phone = $_POST['phone'] ?? 'No Phone Number Added';
        $whatsapp = $_POST['whatsapp'] ?? 'No Number Added';
        $business_name = trim($_POST['business_name']);
        $business_desc = trim($_POST['business_desc']);
        $sales_problem = trim($_POST['sales_problem']);
        $objectives = trim($_POST['objectives']);
        $barrier = trim($_POST['barrier']);
        $industry = $_POST['industry'];
        $budget = $_POST['budget'];
        $timeline = $_POST['timeline'];
        $decision_maker = $_POST['decision_maker'];
        $notes = $_POST['notes'] ?? 'No Note Added'; 


        $premium = new Premium();
        $premium->full_name = $full_name;
        $premium->email = $email;
        $premium->phone = $phone;
        $premium->whatsapp = $whatsapp;
        $premium->business_name = $business_name;
        $premium->business_desc = $business_desc;
        $premium->sales_problem = $sales_problem;
        $premium->objectives = $objectives;
        $premium->barrier = $barrier;
        $premium->industry = $industry;
        $premium->budget = $budget;
        $premium->timeline = $timeline;
        $premium->decision_maker = $decision_maker;
        $premium->notes = $notes;

        if($premium->save()){
            redirect('../../thank-you');
        }else{
            redirect("../../404");
        }

    }else{
        echo "Nawa oo";
    }




?>