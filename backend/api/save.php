<?php
require_once("../config/init.php");

// Set headers for plain text response (since we're not using JSON)
header('Content-Type: text/plain');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $name = isset($_POST['cs2Name']) ? trim(strip_tags($_POST['cs2Name'])) : '';
    $email = isset($_POST['cs2Email']) ? trim(filter_var($_POST['cs2Email'], FILTER_SANITIZE_EMAIL)) : '';

    // Validate inputs
    if (empty($name)) {
        die('Name is required.');
    } elseif (strlen($name) < 3) {
        die('Name must be at least 3 characters.');
    } elseif (empty($email)) {
        die('Email is required.');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }


    $customer = new Customers();
    $customer->name = $name;
    $customer->email = $email;
    $customer->created_at = now();

    if ($customer->save()) {
        die('success');
    }
} else {
    die('Invalid request method.');
}
