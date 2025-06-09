<?php
include("./backend/config/init.php");
$settings = Settings::findOrFail(1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Thank You</title>
	<link rel="shortcut icon" href="<?= $settings->imageShow() ?>">
	<link rel="apple-touch-icon" href="<?= $settings->imageShow() ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= $settings->imageShow() ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= $settings->imageShow() ?>">
	<link rel="icon" href="<?= $settings->imageShow() ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
	<style>
		body {
			background-color: #f0f4f8;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			background-image: url('./images/files/parallax-bg/img-1.png');
			background-position: center;
			/* background-attachment: fixed */
		}

		.thank-you-box {
			background-color: white;
			padding: 40px;
			border-radius: 20px;
			text-align: center;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
			max-width: 500px;
		}

		.thank-you-box p {
			font-size: 1.1rem;
			color: #333;
			margin-top: 15px;
		}

		.thank-you-box .btn-home {
			margin-top: 25px;
			border-radius: 30px;
		}
	</style>
</head>

<body>

	<div class="thank-you-box">
		<h1 class="text-primary">Thank You!</h1>
		<p>We’ve received your submission and will get back to you within the next 24 hours.</p>
		<p>Please check your email inbox for our response.</p>
		<a href="./" class="btn btn-primary btn-home">Back to Homepage</a>
	</div>

</body>

</html>