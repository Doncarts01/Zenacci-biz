<?php include("./inc/topnav.php") ?>
<?php
$page = "Settings";

$alertType = false;
$message = '';
$settings = null;

try {
    $settings = Settings::findOrFail(1);
} catch (Exception $e) {
    // Handle error if settings can't be loaded
    $_SESSION['error'] = "Failed to load settings ooo: " . $e->getMessage();
}

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
        $phone = trim($_POST['phone']);
        $text = trim($_POST['text']);
        $description = trim($_POST['description']);


        // Update settings
        $settings->email = $email;
        $settings->phone = $phone;
        $settings->text = $text;
        $settings->description = $description;

        // Handle file upload if present
        if (!empty($_FILES['logo']['name'])) {
            $settings->set_file($_FILES['logo']);
        }

        if ($settings->save()) {
            $_SESSION['message'] = "Settings successfully updated";
            redirect("settings.php");
            exit();
        } else {
            throw new Exception("Failed to save settings");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("settings.php");
        exit();
    }
}
?>



<div class="container-fluid" style="padding-bottom: 100px;">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small>Settings</small>
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
            <div class="">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
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


                                <form role="form" action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        <label class="form-label">LOGO</label>
                                        <input type="file" id="image" class="form-control" name="logo">
                                    </div>
                                    <figure class="profile">
                                        <img src="<?php echo $settings->imageShow() ?>" class="profile-img img-thumbmail my-3" style="width:100px;height:100px;object-fit:cover;object-position:top;" id="showImage" />
                                    </figure>
                                    <div class="form-group mb-3 mt-4">
                                        <label class="form-label">Contact Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= $settings->email ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Phone No </label>
                                        <input type="text" id="phoneNo" name="phone" class="form-control" value="<?= $settings->phone ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Header Text</label>
                                        <input type="text" name="text" class="form-control" value="<?= $settings->text ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea rows="3" name="description" id="description" class="form-control" maxlength="200" style="resize: none;"><?= $settings->description ?></textarea>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary w-100">Update Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>

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