<?php include("./inc/topnav.php") ?>
<?php
$page = "Partners";

$alertType = false;
$message = '';
$settings = null;

$partners = Partners::all()->orderBy('id', 'DESC');

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
    $url = $_POST['url'];

    try {
        $partners = new Partners();
        $partners->url = $url;

        // Handle file upload if present
        if (!empty($_FILES['image']['name'])) {
            $partners->set_file($_FILES['image']);
        }


        if ($partners->save()) {
            $_SESSION['message'] = "Partner created successfully";
            redirect("partners.php");
            exit();
        } else {
            throw new Exception("Failed to save Partner");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("partners.php");
        exit();
    }


endif;

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])):
    $url = $_POST['url'];


    try {
        $partners = Partners::findOrFail($_POST['id']);
        $partners->url = $url;

        // Handle file upload if present
        if (!empty($_FILES['image']['name'])) {
            $partners->set_file($_FILES['image']);
        }


        if ($partners->save()) {
            $_SESSION['message'] = "Partner Updated successfully";
            redirect("partners.php");
            exit();
        } else {
            throw new Exception("Failed to Update partner");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect("partners.php");
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

            <button type="button" class="btn btn-primary d-flex mb-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Partner</button>

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
                            <h5 class="modal-title" id="exampleModalLabel">Add Partner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" id="image" class="form-control" name="image" require_once>
                                </div>
                                <figure class="profile">
                                    <img src="../uploads/no_image.jpg" class="profile-img img-thumbmail my-3" style="width: 150px;height:60px;" id="showImage" />
                                </figure>
                                <div class="form-group">
                                    <label for="url" class="col-form-label">URL:</label>
                                    <input type="text" class="form-control" id="url" name="url">
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
                        <th>Image</th>
                        <th>URL</th>
                        <th>Action</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($partners)):
                        $i = 1;
                        foreach ($partners as $item):
                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <img class="img-thumbnail" src="<?= $item->imageShow() ?>" alt="Card image cap" width="100px" height="60px">
                                </td>
                                <td><?= $item->url ?></td>
                                <td>
                                    <a type="button" data-toggle="modal" data-target="#exampleModal<?= $item->id ?>" data-whatever="@getbootstrap" class="btn btn-info sm" title="Edit Data"> <i class="fa fa-edit"></i> </a>
                                    <a href="partners.php?id=<?= base64_encode($item->id) ?>" class="btn btn-danger sm" title="Delete Data" id="delete" onclick="return confirm('Are you sure you want to delete this file?')"> <i class="fa fa-trash"></i> </a>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Update partners</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <?php
                                            $updatePartner= Partners::findOrFail($item->id);
                                            ?>

                                            <input type="hidden" name="id" value="<?= $item->id ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" id="image<?= $item->id ?>" class="form-control" name="image">
                                                </div>
                                                <figure class="profile">
                                                    <img src="<?= $item->imageShow() ?>" class="profile-img img-thumbmail my-3" style="width:150px;height:60px;" id="showImage<?= $item->id ?>" />
                                                </figure>
                                                <div class="form-group">
                                                    <label for="url" class="col-form-label">URL:</label>
                                                    <input type="text" class="form-control" id="url" name="url" value="<?= $item->url ?>">
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


                            <script>
                                $('#image<?= $item->id ?>').change(function(e) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#showImage<?= $item->id ?>').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(e.target.files['0']);
                                });
                            </script>
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
        $partner = Partners::findOrFail($id);
        $image = $partner->image;
        unlink($image);
        if ($partner->delete()) {
            $_SESSION['message'] = "Partner deleted successfully";
            redirect("partners.php");
            exit();
        } else {
            throw new Exception("Failed to save partner");
        }
    } catch (Exception $e) {
        //throw $th;
        $_SESSION['error'] = $e->getMessage();
        redirect("partners.php");
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
        // $('#example').DataTable({
        //     dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        //         "<'row'<'col-sm-12'tr>>" +
        //         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        //     buttons: [{
        //             extend: 'copy',
        //             className: 'btn btn-primary',
        //             text: '<i class="fa fa-copy"></i> Copy'
        //         },
        //         {
        //             extend: 'csv',
        //             className: 'btn btn-info',
        //             text: '<i class="fa fa-file-csv"></i> CSV'
        //         },
        //         {
        //             extend: 'excel',
        //             className: 'btn btn-success',
        //             text: '<i class="fa fa-file-excel"></i> Excel'
        //         },
        //         {
        //             extend: 'pdf',
        //             className: 'btn btn-danger',
        //             text: '<i class="fa fa-file-pdf"></i> PDF'
        //         },
        //         {
        //             extend: 'print',
        //             className: 'btn btn-warning',
        //             text: '<i class="fa fa-print"></i> Print'
        //         }
        //     ],
        //     responsive: true,
        //     lengthMenu: [
        //         [10, 25, 50, 100, -1],
        //         [10, 25, 50, 100, "All"]
        //     ], // Add this line
        //     pageLength: 10, // Default number of rows to show
        //     language: {
        //         search: "_INPUT_",
        //         searchPlaceholder: "Search...",
        //         lengthMenu: "Show _MENU_ entries", // This controls the "Show X entries" dropdown
        //         info: "Showing _START_ to _END_ of _TOTAL_ entries",
        //         infoEmpty: "Showing 0 to 0 of 0 entries",
        //         infoFiltered: "(filtered from _MAX_ total entries)",
        //         paginate: {
        //             first: "First",
        //             last: "Last",
        //             next: "Next",
        //             previous: "Previous"
        //         }
        //     }
        // });
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