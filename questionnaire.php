<?php
session_start();
// Save user info from signup/login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['username'] = $_POST['username'] ?? '';
    $_SESSION['gender'] = $_POST['gender'] ?? ($_SESSION['gender'] ?? '');
    $_SESSION['location'] = $_POST['location'] ?? ($_SESSION['location'] ?? '');
    $_SESSION['periods_regular'] = $_POST['periods_regular'] ?? '';
    $_SESSION['menstrual_pain'] = $_POST['menstrual_pain'] ?? '';
}
$username = $_SESSION['username'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$location = $_SESSION['location'] ?? '';
$isFemale = ($gender === 'female');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Track-Well</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-sm" style="min-width: 320px; max-width: 500px;">
            <h2 class="mb-2 text-center">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <div class="mb-4 text-center">How can we help you today?</div>
            <div class="d-grid gap-3 mb-2">
                <form method="post" action="questionnaire.php">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
                    <input type="hidden" name="location" value="<?php echo htmlspecialchars($location); ?>">
                    <button type="submit" name="health_type" value="physical" class="btn btn-custom option-btn">Physical Health</button>
                    <button type="submit" name="health_type" value="mental" class="btn btn-outline-primary option-btn">Mental Health</button>
                </form>
            </div>
            <a href="index.php" class="btn btn-link w-100">Logout</a>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php
// If health type is selected, show questions
if (isset($_POST['health_type'])) {
    $healthType = $_POST['health_type'];
    $_SESSION['health_type'] = $healthType;
    header('Location: suggestions.php');
    exit();
}
?>
