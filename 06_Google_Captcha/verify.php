<?php

session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit();
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$captcha_token = $_POST['g-recaptcha-response'] ?? '';


if (empty($captcha_token)) {
    $_SESSION['error_msg'] = "Please complete the reCAPTCHA verification.";
    header("Location: login.php");
    exit();
}


$verification_url = 'https://www.google.com/recaptcha/api/siteverify';
$request_data = [
    'secret'   => RECAPTCHA_SECRET_KEY,
    'response' => $captcha_token,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $verification_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$response_keys = json_decode($response, true);

if ($response_keys["success"]) {
    
    $_SESSION['success_msg'] = "Welcome back, " . htmlspecialchars($username) . "! Login authorized.";
    header("Location: login.php");
    exit();
} else {

    $_SESSION['error_msg'] = "reCAPTCHA verification failed. Please try again.";
    header("Location: login.php");
    exit();
}
?>