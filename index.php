<?php
// Start session to track user state
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track-Well</title>
    <!-- Bootstrap CSS for responsive design -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Custom styles for Track-Well -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Centered container for logo and form -->
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <!-- App Logo -->
        <img src="assets/images/logo.svg" alt="Track-Well Logo" class="logo mb-3 animate__animated animate__bounceIn">
        <!-- Animated App Title -->
        <div class="animated-title mb-4">Track-Well</div>
        <!-- Card for login/signup options -->
        <div class="card p-4 shadow-sm" style="min-width: 320px; max-width: 400px;">
            <div class="mb-3 text-center">
                <span style="font-size:1.1rem;">Welcome to Track-Well! Please sign in or log in to continue.</span>
            </div>
            <div class="d-grid gap-2 mb-2">
                <!-- Sign Up Button -->
                <a href="signup.php" class="btn btn-custom option-btn">Sign Up</a>
                <!-- Log In Button -->
                <a href="login.php" class="btn btn-outline-primary option-btn">Log In</a>
                <!-- Google Sign-In Button -->
                <button type="button" class="btn btn-danger option-btn" id="google-signin">
                    <img src="https://cdn.jsdelivr.net/gh/google/material-design-icons/symbols/svg/social/google.svg" style="height:1.2em;vertical-align:middle;margin-right:8px;">Sign in with Google
                </button>
            </div>
        </div>
    </div>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>
