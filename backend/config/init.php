<?php
// Start the session
session_start();
ob_start();

// Include Composer's autoloader
// require_once __DIR__ . '/../../vendor/autoload.php';


// Define constants
defined("DS") ? null : define('DS', DIRECTORY_SEPARATOR);
defined("UPLOADS") ? null : define('UPLOADS', $_SERVER['DOCUMENT_ROOT']);

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$base_url = "{$protocol}://{$host}";

defined("SITE_ROOT") ? null : define('SITE_ROOT', $base_url);
defined("CALLBACK") ? null : define('CALLBACK', $base_url . "/");

// Load .env file
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
// $dotenv->load();

// Include required files
require_once(__DIR__ . DS . "db.php");
require_once(__DIR__ . DS . "db_object.php");
require_once(__DIR__ . DS . "session.php");
require_once(__DIR__ . DS . "functions.php");
require_once(__DIR__ . DS . "collection.php");
require_once(__DIR__ . DS . "mailer.php");

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "adminController.php");
require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "settingsController.php");
require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "servicesController.php");
require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "pricingController.php");
require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "customersController.php");
require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "partnersController.php");
require_once(__DIR__ . DS . ".." . DS . "controllers" . DS . "premiumController.php");

?>