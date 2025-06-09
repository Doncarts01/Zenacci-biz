<?php
include("./backend/config/init.php");
$settings = Settings::findOrFail(1);

if (!isset($_GET['package']) || $_GET['package'] == '' || $_SERVER['REQUEST_METHOD'] != 'GET') {
    redirect("./");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sales Growth Strategy Form</title>
    <link rel="icon" href="<?= $settings->imageShow() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Base styles */
        body {
            background-color: #f8f9fa;
            padding: 0;
            margin: 0;
        }
        
        /* Modal fullscreen and scrollable */
        .modal-dialog.modal-dialog-scrollable {
            display: flex;
            min-height: 100vh;
            margin: 0 auto;
        }
        
        .modal-dialog.modal-dialog-scrollable .modal-content {
            max-height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .modal-dialog.modal-dialog-scrollable .modal-body {
            overflow-y: auto;
            flex: 1;
            padding-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 0;
                width: 100%;
                max-width: 100%;
                height: 100vh;
            }
            .modal-content {
                border-radius: 0;
                height: 100vh;
            }
        }
        
        /* Step wizard styles */
        .step {
            display: none;
            padding: 0 5px;
        }
        .step.active {
            display: block;
        }
        
        /* Progress bar styling */
        .progress {
            height: 30px;
            margin: 15px 0;
        }
        .progress-bar {
            transition: width 0.3s ease;
        }
        .progress-bar-text {
            position: absolute;
            width: 100%;
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            color: #000;
            z-index: 10;
        }
        
        /* Error message styling */
        .error-msg {
            color: #dc3545 !important;
            font-weight: bold;
            margin-top: 10px;
            display: none;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        
        /* Button styling */
        .btn {
            padding: 10px 20px;
            font-weight: 500;
            min-width: 100px;
        }
        
        /* Form input styling */
        .form-control, .form-select {
            padding: 12px 15px;
            margin-bottom: 15px;
        }
        textarea.form-control {
            min-height: 100px;
        }
        
        /* Modal header styling */
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .modal-title {
            font-weight: 600;
            color: #212529;
        }
        
        /* Modal footer styling */
        .modal-footer {
            position: sticky;
            bottom: 0;
            background: white;
            border-top: 1px solid #dee2e6;
            padding: 15px;
            z-index: 100;
        }
        
        /* Better spacing for form elements */
        .mb-3 {
            margin-bottom: 1.2rem !important;
        }
    </style>
</head>

<body>
      <div class="container d-flex justify-content-center align-items-center gap-4" style="height: 100vh;background-image:url('./images/files/parallax-bg/img-1.png');background-position:center;background-attachment:fixed">
        <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#strategyModal">
            Get Premium Package
        </button>
        <button type="button" class="btn btn-dark btn-custom" onclick="window.location.href='./'">
            Home
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="strategyModal" tabindex="-1" aria-labelledby="strategyModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
            <div class="modal-content" style="overflow-y:auto">
                <form id="multiStepForm" action="./backend/api/process.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Let's Personalize Your Sales Growth Strategy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress position-relative mx-3 mt-2">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" id="progressBar"></div>
                        <span class="progress-bar-text" id="progressText">Step 1 of 4</span>
                    </div>

                    <div class="modal-body" style="overflow-y:auto">
                        <!-- Step 1 -->
                        <div class="step active" id="step1">
                            <div class="mb-3">
                                <label class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number (optional)</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">WhatsApp Number (optional)</label>
                                <input type="text" class="form-control" name="whatsapp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Business Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="business_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tell us about your business. What do you sell, and who is your target audience?
                                    <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="business_desc" required></textarea>
                            </div>
                            <p class="error-msg">Please fill all required fields in this section</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="step" id="step2">
                            <div class="mb-3">
                                <label class="form-label">What's the specific sales & business growth problem you want to solve?<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="sales_problem" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">What are your key objectives or desired outcomes from this project?<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="objectives" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">What do you think is holding you back from hitting your sales and profit goals? <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="barrier" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">What industry are you in?<span class="text-danger">*</span></label>
                                <select class="form-select" name="industry" required>
                                    <option value="" selected disabled>Choose...</option>
                                    <option>E-commerce</option>
                                    <option>Technology</option>
                                    <option>Services</option>
                                    <option>Manufacturing</option>
                                    <option>Real Estate</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <p class="error-msg">Please fill all required fields in this section</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="step" id="step3">
                            <div class="mb-3">
                                <label class="form-label">What is your estimated monthly budget for paid advertising and marketing campaigns (e.g., Facebook Ads, Google Ads)?<span class="text-danger">*</span></label>
                                <select class="form-select" name="budget" required>
                                    <option value="">Select</option>
                                    <option>$30 – $170</option>
                                    <option>$170 – $330</option>
                                    <option>$330 – $670</option>
                                    <option>$670+</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">What is your desired timeline for starting and completing this project? <span class="text-danger">*</span></label>
                                <select class="form-select" name="timeline" required>
                                    <option value="">Choose</option>
                                    <option>Within 1 month (Urgent)</option>
                                    <option>1-3 months</option>
                                    <option>3-6 months</option>
                                    <option>Just exploring options</option>
                                </select>
                            </div>
                            <p class="error-msg">Please fill all required fields in this section</p>
                        </div>

                        <!-- Step 4 -->
                        <div class="step" id="step4">
                            <div class="mb-3">
                                <label class="form-label">Are you the final decision-maker when it comes to investing in your business growth? <span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="decision_maker" id="decisionYes" value="Yes" required>
                                    <label class="form-check-label" for="decisionYes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="decision_maker" id="decisionNo" value="No" required>
                                    <label class="form-check-label" for="decisionNo">No</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Anything else you'd like us to know? (optional)</label>
                                <textarea class="form-control" name="notes"></textarea>
                            </div>
                            <p class="error-msg">Please fill all required fields in this section</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="prevBtn">Back</button>
                        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                        <button type="submit" name="submit" class="btn btn-success" id="submitBtn" style="display: none;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show modal automatically when page loads
            const strategyModal = new bootstrap.Modal(document.getElementById('strategyModal'));
            strategyModal.show();

            const steps = document.querySelectorAll('.step');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const submitBtn = document.getElementById('submitBtn');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const errorMsgs = document.querySelectorAll('.error-msg');

            let currentStep = 0;

            function updateForm() {
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });

                prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
                nextBtn.style.display = currentStep < steps.length - 1 ? 'inline-block' : 'none';
                submitBtn.style.display = currentStep === steps.length - 1 ? 'inline-block' : 'none';

                const percent = ((currentStep + 1) / steps.length) * 100;
                progressBar.style.width = percent + '%';
                progressText.textContent = `Step ${currentStep + 1} of ${steps.length}`;

                // Hide all error messages when switching steps
                errorMsgs.forEach(msg => msg.style.display = 'none');
                
                // Scroll to top of modal body when step changes
                document.querySelector('.modal-body').scrollTop = 0;
            }

            function validateCurrentStep() {
                const currentStepElement = steps[currentStep];
                const requiredFields = currentStepElement.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (field.type === 'radio') {
                        const radioGroup = document.getElementsByName(field.name);
                        const isRadioChecked = Array.from(radioGroup).some(radio => radio.checked);
                        
                        if (!isRadioChecked) {
                            isValid = false;
                            radioGroup.forEach(radio => {
                                radio.classList.add('is-invalid');
                            });
                        } else {
                            radioGroup.forEach(radio => {
                                radio.classList.remove('is-invalid');
                            });
                        }
                    } else if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    currentStepElement.querySelector('.error-msg').style.display = 'block';
                    // Scroll to first error
                    const firstError = currentStepElement.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }

                return isValid;
            }

            nextBtn.addEventListener('click', () => {
                if (validateCurrentStep()) {
                    if (currentStep < steps.length - 1) currentStep++;
                    updateForm();
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) currentStep--;
                updateForm();
            });

            document.getElementById('multiStepForm').addEventListener('submit', function(e) {
                // Final validation before submit
                if (!validateCurrentStep()) {
                    e.preventDefault();
                }
            });

            // Initialize the form
            updateForm();
        });
    </script>
</body>
</html>