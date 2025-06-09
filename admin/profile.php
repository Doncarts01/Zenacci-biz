<?php include("./inc/topnav.php") ?>
<?php
$page = "Profile Settings";

$alertType = false;
$message = '';
$settings = null;



// Check for existing messages in session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $alertType = 'success';
    unset($_SESSION['message']);
} elseif (isset($_SESSION['error'])) {
    $message = $_SESSION['error'];
    $alertType = 'danger';
    unset($_SESSION['error']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    try {
        // Sanitize inputs
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);



        // Update settings
        $admin->username = $username;
        $admin->email = $email;



        if ($admin->save()) {
            $_SESSION['message'] = "Profile successfully updated";
            redirect("profile.php");
            exit();
        } else {
            throw new Exception("Failed to update Profile");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("profile.php");
        exit();
    }
}

$errors = ['old_password' => '', 'new_password' => '', 'confirm_password' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change'])) {
    try {
        // Sanitize inputs
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($old_password)) {
            $errors['old_password'] = "Old password is required.";
        }else if(!password_verify($old_password, $admin->password)){
            $errors['old_password'] = "Old password is incorrect.";
        }


        if (empty($new_password)) {
            $errors['new_password'] = "New password is required.";
        } elseif (strlen($new_password) < 8) {
            $errors['new_password'] = "New password must be at least 8 characters long.";
        }

        if (empty($confirm_password)) {
            $errors['confirm_password'] = "Confirm password is required.";
        }

        if ($new_password !== $confirm_password) {
            $errors['confirm_password'] = "New password and confirm password do not match.";
        }


        // If no errors, create the user
        if (empty(array_filter($errors))) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $admin->password = $hashedPassword;
            if ($admin->save()) {
                $_SESSION['message'] = "Password successfully updated";
                redirect("profile.php");
                exit();
            } else {
                throw new Exception("Failed to update Profile");
            }
        }
        // Update settings
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("profile.php");
        exit();
    }
}

?>



<div class="container-fluid" style="padding-bottom: 100px;">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small><?= $page ?></small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> <?= $page ?>
                </li>
            </ol>
        </div>


        <div class="col-lg-12">
            <div class="d-flex justify-content-center">


                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <section class="row">
                                <!-- Display alerts if message exists -->
                                <?php if ($message): ?>
                                    <div class="alert alert-<?php echo $alertType; ?> alert-dismissible show" role="alert">
                                        <?php if ($alertType == 'success'): ?>
                                            <strong>Success!</strong> <?php echo $message; ?>
                                        <?php else: ?>
                                            <strong>Error!</strong> <?php echo $message; ?>
                                        <?php endif; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </section>

                        </div>
                    </div>


                </div>


                <div class="col-md-6 col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form role="form" action="" method="POST" enctype="multipart/form-data">
                                <h4>Update Profile</h4>
                                <div class="form-group mb-3 mt-4">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $admin->username ?>">
                                </div>
                                <div class="form-group mb-3 mt-4">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" value="<?= $admin->email ?>">
                                </div>
                                <button type="submit" name="update" class="btn btn-primary w-100">Update Profile</button>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form role="form" action="" method="POST" enctype="multipart/form-data">
                                <h4>Change Password</h4>

                                <div class="form-group mb-3 mt-4">
                                    <label class="form-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" value="">
                                    <p class="text-danger"><?php echo $errors['old_password'] ?? '' ?></p>
                                </div>
                                <div class="form-group mb-3 mt-4">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control" value="">
                                    <p class="text-danger"><?php echo $errors['new_password'] ?? '' ?></p>
                                </div>
                                <div class="form-group mb-3 mt-4">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" value="">
                                    <p class="text-danger"><?php echo $errors['confirm_password'] ?? '' ?></p>
                                </div>

                                <button type="submit" name="change" class="btn btn-danger w-100">Update Password</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <script>
            document.getElementById('phoneNo').addEventListener('input', function(event) {
                let value = event.target.value;
                let newValue = value.replace(/[^+0-9]/g, '');

                if (newValue.indexOf('+') !== -1) {
                    newValue = newValue.replace(/\+/g, '');
                    newValue = '+' + newValue;
                }

                if (newValue.length > 14) {
                    newValue = newValue.substring(0, 14);
                }

                event.target.value = newValue;
            });
        </script>
        <?php include("./inc/footer.php") ?>

        <script type="text/javascript">
            $(document).ready(function() {
                // post image 
                $('#image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>