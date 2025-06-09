<?php include("./inc/topnav.php") ?>
<?php
$page = "Premium Customer Lists";

$customers = Premium::all()->orderBy('id', 'DESC');



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
// create
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

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
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

                </div>
            </div>

            <!-- <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class=" ">
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)):
                        $i = 1;
                        foreach ($customers as $item):
                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $item->full_name ?></td>
                                <td>
                                    <a href="mailto:<?= $item->email ?>">
                                        <?= $item->email ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $date = new DateTime($item->created_at);

                                    ?>
                                    <?= $date->format("d M, Y") ?>
                                </td>
                                <td>
                                    <a href="view-customer.php?id=<?= base64_encode($item->id) ?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="premium.php?id=<?= base64_encode($item->id) ?>" class="btn btn-danger" id="delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table> -->

            <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class=" ">
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <!-- Hidden columns for export -->
                        <th style="display: none;">Phone</th>
                        <th style="display: none;">WhatsApp</th>
                        <th style="display: none;">Business Name</th>
                        <th style="display: none;">Business Description</th>
                        <th style="display: none;">Industry</th>
                        <th style="display: none;">Budget</th>
                        <th style="display: none;">Sales Problem</th>
                        <th style="display: none;">Objectives</th>
                        <th style="display: none;">Barriers</th>
                        <th style="display: none;">Timeline</th>
                        <th style="display: none;">Decision Maker</th>
                        <th style="display: none;">Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)):
                        $i = 1;
                        foreach ($customers as $item):
                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $item->full_name ?></td>
                                <td>
                                    <a href="mailto:<?= $item->email ?>">
                                        <?= $item->email ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $date = new DateTime($item->created_at);
                                    echo $date->format("d M, Y");
                                    ?>
                                </td>
                                <!-- Hidden columns (for export) -->
                                <td style="display: none;"><?= !empty($item->phone) ? htmlspecialchars($item->phone) : 'N/A' ?></td>
                                <td style="display: none;"><?= !empty($item->whatsapp) ? htmlspecialchars($item->whatsapp) : 'N/A' ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->business_name) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->business_desc) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->industry) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->budget) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->sales_problem) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->objectives) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->barrier) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($item->timeline) ?></td>
                                <td style="display: none;"><?= $item->decision_maker == 'Yes' ? 'Yes' : 'No' ?></td>
                                <td style="display: none;"><?= !empty($item->notes) ? htmlspecialchars($item->notes) : 'N/A' ?></td>
                                <td>
                                    <a href="view-customer.php?id=<?= base64_encode($item->id) ?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="premium.php?id=<?= base64_encode($item->id) ?>" class="btn btn-danger" id="delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
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
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $customer = Premium::findOrFail($id);

    if ($customer) {
        $customer->delete();
        $_SESSION['message'] = "Item deleted successfully";
        redirect('premium.php');
        exit;
    } else {
        $_SESSION['error'] = "Unable to delete Item";
        redirect('premium.php');
        exit;
    }
}
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

<!-- <script>
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
</script> -->


<script>
    $(document).ready(function() {
        // Initialize DataTable with export customization
        $('#example').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-copy"></i> Copy',
                    exportOptions: {
                        columns: ':visible' // Export only visible columns by default
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn btn-info',
                    text: '<i class="fa fa-file-csv"></i> CSV',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the "Action" column
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the "Action" column
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the "Action" column
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Print',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the "Action" column
                    }
                }
            ],
            responsive: true,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            columnDefs: [{
                    targets: -1, // Action column (last column)
                    orderable: false, // Disable sorting
                    searchable: false // Disable search
                },
                {
                    targets: [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14], // Hidden columns (indices start from 0)
                    visible: false, // Hide in UI
                    exportable: true // But include in exports
                }
            ]
        });
    });
</script>