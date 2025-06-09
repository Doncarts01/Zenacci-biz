<?php include("./inc/topnav.php") ?>
<?php
$page = "User Package Details";

if (!isset($_GET['id']) && empty($_GET['id'])) {
    redirect('premium.php');
    exit();
}

$id = base64_decode($_GET['id']);
$user = Premium::findOrFail($id);
?>



<div class="container-fluid" style="padding-bottom: 100px;">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small><?= $page ?></small>
            </h1>
        </div>



        <div class="col-lg-12">
            <div class="">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="container-fluid my-5">
                                    <div class="card shadow-lg border-0">
                                        <div class="card-header bg-primary text-white" style="padding: 2px 12px;margin-bottom:5px">
                                            <h4 class="mb-0 ">Submission Details</h4>
                                        </div>
                                        <button id="exportToCsv" class="btn btn-sm btn-success float-end">Export to CSV</button>
                                        <div class="card-body px-4">
                                            <div class="row g-4">
                                                <!-- Personal Information Section -->
                                                <div class="col-12">
                                                    <h5 class="text-primary mb-3 border-bottom pb-2"><i class="bi bi-person-circle me-2"></i>Personal Information</h5>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Full Name</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= htmlspecialchars($user->full_name) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Email</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= htmlspecialchars($user->email) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Phone</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= !empty($user->phone) ? htmlspecialchars($user->phone) : 'No Number Added' ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">WhatsApp</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= !empty($user->whatsapp) ? htmlspecialchars($user->whatsapp) : 'No Number Added' ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Business Information Section -->
                                                <div class="col-12 mt-4">
                                                    <h5 class="text-primary mb-3 border-bottom pb-2"><i class="bi bi-briefcase me-2"></i>Business Information</h5>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Business Name</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= htmlspecialchars($user->business_name) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Business Description</label>
                                                        <div class="p-3 bg-light rounded-2 border" style="white-space: pre-wrap; word-wrap: break-word;"><?= nl2br(htmlspecialchars($user->business_desc)) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Industry</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= htmlspecialchars($user->industry) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Estimated Budget</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;">
                                                            <?= htmlspecialchars($user->budget) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Project Details Section -->
                                                <div class="col-12 mt-4">
                                                    <h5 class="text-primary mb-3 border-bottom pb-2"><i class="bi bi-clipboard-data me-2"></i>Project Details</h5>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Sales/Business Growth Problem</label>
                                                        <div class="p-3 bg-light rounded-2 border" style="white-space: pre-wrap; word-wrap: break-word;"><?= nl2br(htmlspecialchars($user->sales_problem)) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Objectives / Desired Outcomes</label>
                                                        <div class="p-3 bg-light rounded-2 border" style="white-space: pre-wrap; word-wrap: break-word;"><?= nl2br(htmlspecialchars($user->objectives)) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Barriers to Success</label>
                                                        <div class="p-3 bg-light rounded-2 border" style="white-space: pre-wrap; word-wrap: break-word;"><?= nl2br(htmlspecialchars($user->barrier)) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Timeline</label>
                                                        <div class="p-3 bg-light rounded-2 border" style=" word-wrap: break-word;"><?= htmlspecialchars($user->timeline) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-muted small">Decision Maker</label>
                                                        <div class="p-3 bg-light rounded-2 border">
                                                            <?= $user->decision_maker == 'Yes' ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($user->notes)) : ?>
                                                    <div class="col-12 mt-4">
                                                        <h5 class="text-primary mb-3 border-bottom pb-2"><i class="bi bi-pencil-square me-2"></i>Additional Notes</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="p-3 bg-light rounded-2 border" style="white-space: pre-wrap; word-wrap: break-word;"><?= nl2br(htmlspecialchars($user->notes)) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    .form-group {
                                        margin-bottom: 1rem;
                                    }

                                    .card {
                                        border-radius: 0.5rem;
                                    }

                                    .card-header {
                                        border-radius: 0.5rem 0.5rem 0 0 !important;
                                    }

                                    .bg-light {
                                        background-color: #f8f9fa !important;
                                        padding: 8px;
                                    }

                                    .border {
                                        border: 1px solid #dee2e6 !important;
                                    }
                                </style>





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
    document.getElementById('exportToCsv').addEventListener('click', function() {
        // Get all the data from the page
        const data = {
            'Full Name': '<?= htmlspecialchars($user->full_name) ?>',
            'Email': '<?= htmlspecialchars($user->email) ?>',
            'Phone': '<?= !empty($user->phone) ? htmlspecialchars($user->phone) : 'No Number Added' ?>',
            'WhatsApp': '<?= !empty($user->whatsapp) ? htmlspecialchars($user->whatsapp) : 'No Number Added' ?>',
            'Business Name': '<?= htmlspecialchars($user->business_name) ?>',
            'Business Description': '<?= str_replace(["\r", "\n"], ' ', htmlspecialchars($user->business_desc)) ?>',
            'Industry': '<?= htmlspecialchars($user->industry) ?>',
            'Estimated Budget': '<?= htmlspecialchars($user->budget) ?>',
            'Sales/Business Growth Problem': '<?= str_replace(["\r", "\n"], ' ', htmlspecialchars($user->sales_problem)) ?>',
            'Objectives / Desired Outcomes': '<?= str_replace(["\r", "\n"], ' ', htmlspecialchars($user->objectives)) ?>',
            'Barriers to Success': '<?= str_replace(["\r", "\n"], ' ', htmlspecialchars($user->barrier)) ?>',
            'Timeline': '<?= htmlspecialchars($user->timeline) ?>',
            'Decision Maker': '<?= $user->decision_maker ?>',
            'Additional Notes': '<?= !empty($user->notes) ? str_replace(["\r", "\n"], ' ', htmlspecialchars($user->notes)) : '' ?>'
        };

        // Convert to CSV
        const csvRows = [];
        const headers = Object.keys(data);
        csvRows.push(headers.join(','));

        const values = headers.map(header => {
            const escaped = ('' + data[header]).replace(/"/g, '\\"');
            return `"${escaped}"`;
        });
        csvRows.push(values.join(','));

        const csvContent = csvRows.join('\n');

        // Download the file
        const blob = new Blob([csvContent], {
            type: 'text/csv;charset=utf-8;'
        });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', 'user_package_<?= $user->id ?>.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
</script>

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