<?php
require_once("../backend/config/init.php");

    $session->logout();
    redirect('./login.php');
    exit();
?>