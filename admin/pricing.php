<?php include("./inc/topnav.php") ?>
<?php
$page = "Pricing";

$alertType = false;
$message = '';
$settings = null;

$pricings = Pricing::all()->orderBy('id', 'DESC');

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
// create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])):
    $price = $_POST['price'];
    $plan = $_POST['plan'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $cta = $_POST['cta'];
    $is_form = $_POST['is_form'];
    $url = $_POST['url'];

    try {
        $pricing = new pricing();
        $pricing->plan = $plan;
        $pricing->description = $description;
        $pricing->price = $price;
        $pricing->duration = $duration;
        $pricing->cta = $cta;
        $pricing->is_form = $is_form;
        $pricing->url = $url;

        if ($pricing->save()) {
            $_SESSION['message'] = "Plan created successfully";
            redirect("pricing.php");
            exit();
        } else {
            throw new Exception("Failed to save Plan");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("pricing.php");
        exit();
    }


endif;

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])):
    $price = $_POST['price'];
    $plan = $_POST['plan'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $cta = $_POST['cta'];
    $is_form = $_POST['is_form'];
    $url = $_POST['url'];

    try {
        $pricing = pricing::findOrFail($_POST['id']);
        $pricing->plan = $plan;
        $pricing->description = $description;
        $pricing->price = $price;
        $pricing->duration = $duration;
        $pricing->cta = $cta;
        $pricing->is_form = $is_form;
        $pricing->url = $url;

        if ($pricing->save()) {
            $_SESSION['message'] = "Plan Updated successfully";
            redirect("pricing.php");
            exit();
        } else {
            throw new Exception("Failed to Update Plan");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("pricing.php");
        exit();
    }


endif;









?>

<!-- Add these CSS links in the head section -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">

<style>
    .dt-buttons .btn {
        font-size: 14px;
        padding: 8px 12px;
        margin: 2px;
    }

    .dataTables_filter input {
        font-size: 14px;
        padding: 6px 10px;
        width: 250px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .dataTables_paginate .paginate_button {
        font-size: 14px;
        padding: 6px 12px;
        margin: 2px;
        border-radius: 4px;
    }

    .dataTables_info {
        font-size: 14px;
        padding: 8px 0;
    }

    #example thead th {
        font-size: 16px;
        padding: 12px 10px;
    }

    #example tbody td {
        font-size: 14px;
        padding: 10px;
    }

    .dataTables_wrapper .top {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length {
        margin-right: 10px;
    }

    .dataTables_wrapper .dataTables_filter {
        margin-left: auto;
    }

    .dataTables_wrapper .dt-buttons {
        display: flex;
        gap: 5px;
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length select {
        font-size: 14px;
        padding: 6px 12px;
        height: auto;
        border-radius: 4px;
        border: 1px solid #ccc;
        background-color: #fff;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_length label {
        font-size: 14px;
        margin-bottom: 0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin: 0 2px;
        padding: 4px 8px;
        font-size: 14px;
        border-radius: 4px;
        background-color: #fff;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #883dcf !important;
        color: #fff;
        border-color: #883dcf !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #f8f9fa;
        border-color: #ccc;
    }

    /* Add this new style for button container */
    .dt-buttons.btn-group {
        margin-bottom: 15px;
    }

    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: blueviolet;
        font-weight: 700px;
        background-color: white;
        outline: 2px solid grey;
    }
</style>

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
            <button type="button" class="btn btn-primary d-flex mb-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Create Pricing</button>

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

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Pricing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="plan" class="col-form-label">Plan:</label>
                                    <input type="text" class="form-control" id="plan" name="plan">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="col-form-label">Price:</label>
                                    <input type="text" class="form-control" id="price" name="price" value="FREE">
                                </div>
                                <div class="form-group">
                                    <label for="duration" class="col-form-label">Duration:</label>
                                    <select name="duration" id="duration" class="form-control" required>
                                        <option value="" selected disabled>Choose Duration</option>
                                        <option value="Per Month">Per Month</option>
                                        <option value="Per Year">Per Year</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-form-label">Description:</label>
                                    <textarea style="resize: none;" rows="3" class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cta" class="col-form-label">CTA Button Text:</label>
                                    <input type="text" class="form-control" id="cta" name="cta" placeholder="Get Started">
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-form-label">URL:</label>
                                    <input type="url" class="form-control" id="url" name="url" placeholder="https://www.example.com">
                                </div>
                                <div class="form-group">
                                    <label for="is_form" class="col-form-label">Add a form Modal? (Applicable to Premium package):</label>
                                    <select name="is_form" id="is_form" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="create" class="btn btn-success">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



            <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Plan</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Action</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pricings)):
                        $i = 1;
                        foreach ($pricings as $item):
                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $item->plan ?></td>
                                <td><?= $item->price ?></td>
                                <td><?= $item->duration ?></td>
                                <td>
                                    <a type="button" data-toggle="modal" data-target="#exampleModal<?= $item->id ?>" data-whatever="@getbootstrap" class="btn btn-info sm" title="Edit Data"> <i class="fa fa-edit"></i> </a>
                                    <a href="pricing.php?id=<?= base64_encode($item->id) ?>" class="btn btn-danger sm" title="Edit Data" id="delete"> <i class="fa fa-trash"></i> </a>
                                </td>
                                <td>
                                    <?php
                                    $date = new DateTime($item->updated_at);

                                    ?>
                                    <?= $date->format("d M, Y") ?>
                                </td>
                            </tr>





                            <div class="modal fade" id="exampleModal<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Pricing Plan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $item->id ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="plan" class="col-form-label">Plan:</label>
                                                    <input type="text" class="form-control" id="plan" name="plan" value="<?= $item->plan ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price" class="col-form-label">Price:</label>
                                                    <input type="text" class="form-control" id="price" name="price" value="<?= $item->price ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="duration" class="col-form-label">Duration:</label>
                                                    <select name="duration" id="duration" class="form-control">
                                                        <option value="Per Month" <?= ($item->duration == 'Per Month') ? 'selected' : '' ?>>Per Month</option>
                                                        <option value="Per Year" <?= ($item->duration == 'Per Year') ? 'selected' : '' ?>>Per Year</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="col-form-label">Description:</label>
                                                    <textarea style="resize: none;" rows="3" class="form-control" id="description" name="description"><?= $item->description ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cta" class="col-form-label">CTA Button Text:</label>
                                                    <input type="text" class="form-control" id="cta" name="cta" value="<?= $item->cta ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="url" class="col-form-label">URL:</label>
                                                    <input type="url" class="form-control" id="url" name="url" value="<?= $item->url ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_form" class="col-form-label">Add a form Modal? (Applicable to Premium package):</label>
                                                    <select name="is_form" id="duration" class="form-control">
                                                        <option value="0" <?= ($item->is_form == 0) ? 'selected' : '' ?>>No</option>
                                                        <option value="1" <?= ($item->is_form == 1) ? 'selected' : '' ?>>Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" name="update" class="btn btn-success">Update</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>





















        </div>

        <!-- Modal and other elements remain the same -->
    </div>
</div>










<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])):
    $id = base64_decode($_GET['id']);

    try {
        //code...
        $pricing = Pricing::findOrFail($id);
        if ($pricing->delete()) {
            $_SESSION['message'] = "Pricing plan deleted successfully";
            redirect("pricing.php");
            exit();
        } else {
            throw new Exception("Failed to delete pricing");
        }
    } catch (Exception $e) {
        //throw $th;
        $_SESSION['error'] = $e->getMessage();
        redirect("pricing.php");
        exit();
    }

endif;


?>



<?php include("./inc/footer.php") ?>

<!-- JavaScript Includes - Only include these once -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with proper configuration
        $('#example').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-copy"></i> Copy'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-info',
                    text: '<i class="fa fa-file-csv"></i> CSV'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf"></i> PDF'
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Print'
                }
            ],
            responsive: true,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ], // Add this line
            pageLength: 10, // Default number of rows to show
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "Show _MENU_ entries", // This controls the "Show X entries" dropdown
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
        // Image preview script
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>