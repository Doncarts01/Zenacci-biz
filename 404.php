<?php
include("./backend/config/init.php");
$settings = Settings::findOrFail(1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 Not Found</title>
    <link rel="shortcut icon" href="<?= $settings->imageShow() ?>">
    <link rel="apple-touch-icon" href="<?= $settings->imageShow() ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $settings->imageShow() ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $settings->imageShow() ?>">
    <link rel="icon" href="<?= $settings->imageShow() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .error-container {
            max-width: 500px;
            padding: 40px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .error-code {
            font-size: 6rem;
            font-weight: 700;
            color: #dc3545;
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn-home {
            border-radius: 30px;
            padding: 10px 25px;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <div class="error-code">404</div>
        <h2 class="mb-3">Page Not Found</h2>
        <p class="error-message">Oops! The page you're looking for doesn't exist or has been moved.</p>
        <a href="./" class="btn btn-primary btn-home">Go to Homepage</a>
    </div>

</body>

</html>