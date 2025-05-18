<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Track-Well</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-sm" style="min-width: 320px; max-width: 400px;">
            <h2 class="mb-3 text-center">Sign Up</h2>
            <form method="post" action="questionnaire.php">
                <div class="mb-2">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" id="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Location</label>
                    <select class="form-select" name="location" required>
                        <option value="tenali">Tenali</option>
                        <option value="guntur">Guntur</option>
                        <option value="vijayawada">Vijayawada</option>
                    </select>
                </div>
                <div id="menstrual-section" style="display:none;">
                    <div class="mb-2">
                        <label class="form-label">Are your periods regular?</label>
                        <select class="form-select" name="periods_regular">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Any menstrual pain?</label>
                        <select class="form-select" name="menstrual_pain">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-custom w-100 mt-2">Continue</button>
                <a href="index.php" class="btn btn-link w-100">Back</a>
            </form>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
