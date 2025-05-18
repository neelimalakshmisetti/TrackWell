<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Track-Well</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-sm" style="min-width: 320px; max-width: 400px;">
            <h2 class="mb-3 text-center">Log In</h2>
            <form method="post" action="questionnaire.php">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Continue</button>
                <a href="index.php" class="btn btn-link w-100">Back</a>
            </form>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
