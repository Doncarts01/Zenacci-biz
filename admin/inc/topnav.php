<?php
require_once("../backend/config/init.php")
?>

<?php

if (!$session->is_signed_in()) {
    redirect("login.php");
}

$admin = Admin::findOrFail($session->user_id);
$customers = Premium::all()->orderBy('id', 'DESC');
$adminCount = Admin::all()->count();
$services = Services::all()->count();
$pricing = Pricing::all()->count();
$settings = Settings::findOrFail(1);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= $settings->imageShow() ?>">
    <link rel="apple-touch-icon" href="<?= $settings->imageShow() ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $settings->imageShow() ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $settings->imageShow() ?>">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="js/jquery.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ZENACCI</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("./inc/header.php") ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("./inc/sidebar.php") ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">