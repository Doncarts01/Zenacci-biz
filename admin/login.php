<?php
require_once("../backend/config/init.php")
?>

<?php

if ($session->is_signed_in()) {
    redirect("index.php");
}

$error = ['username' => '', 'email' => '', 'password' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = ['email' => '', 'password' => ''];

    $admin = Admin::findByColumn('email', $email);

    // Check if admin exists
    if (!$admin) {
        $error['email'] = "<span style='color:tomato;'>Email already in use or doesn't exist</span>";
    } else {
        if (!password_verify($password, $admin->password)) {
            $error['password'] = "<span style='color:tomato'>Incorrect Password</span>";
        }
    }


    if (empty(array_filter($error))) {
        $session = new Session();
        $session->login($admin, "admin");

        redirect("./index.php");
        exit();
    }
}
// $admin = new Admin();
// $admin->username = "Zennaci";
// $admin->password = hash_password("asdfghjkl");
// $admin->email = "zennaci@gmail.com";
// $admin->created_at =  $admin->updated_at = time();
// $admin->save();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            text-align: center;
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo img {
            width: 60px;
            height: 60px;
        }

        .logo h1 {
            font-size: 24px;
            color: var(--primary-color);
            margin-top: 15px;
            font-weight: 600;
        }

        .login-form .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .login-form input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 15px;
            transition: var(--transition);
        }

        .login-form input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            width: auto;
            margin-right: 8px;
        }

        .forgot-password a {
            color: var(--dark-gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password a:hover {
            color: var(--primary-color);
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .login-button:hover {
            background-color: var(--primary-dark);
        }

        .divider {
            margin: 25px 0;
            position: relative;
            height: 1px;
            background-color: #e0e0e0;
        }

        .divider::after {
            content: "or";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: var(--white);
            padding: 0 10px;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-gray);
            color: var(--dark-gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-icon:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .footer-text {
            font-size: 14px;
            color: var(--dark-gray);
        }

        .footer-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <!-- <img src="https://via.placeholder.com/60" alt="Company Logo"> -->
            <h1>Admin Portal</h1>
        </div>

        <form class="login-form" method="POST" action="">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email address" name="email" required>
                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>

            </div>


            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" name="password" required>
                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>

            </div>


            <button type="submit" name="login" class="login-button">Login</button>

        </form>
    </div>
</body>

</html>