<?php

$projectRoot = dirname(__DIR__);

// 1. Composer autoloader + .env (loaded first so we know the environment)
if (file_exists($projectRoot . '/vendor/autoload.php')) {
    require_once $projectRoot . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
    $dotenv->load();
} else {
    error_log("Vendor autoloader not found. Run 'composer install'.");
    http_response_code(500);
    die(json_encode(["success" => false, "message" => "Server configuration error."]));
}

// 2. Error display: only in development. Production logs instead of leaking details.
$isProduction = strtolower($_ENV['ENVIRONMENT'] ?? 'development') === 'production';
error_reporting(E_ALL);
ini_set('display_errors', $isProduction ? '0' : '1');
ini_set('log_errors', '1');

// 3. Secure session (must be configured BEFORE session_start)
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax', // Lax (not Strict) so returning from Paystack/redirects keeps users signed in
    ]);
    session_start();
}

// 4. Environment values with safe fallbacks
$api_key = $_ENV['BOOSTING_KEY'] ?? '';
define("HOST", $_ENV['DB_HOST'] ?? 'localhost');
define("USER", $_ENV['DB_USER'] ?? 'root');
define("PASSWORD", $_ENV['DB_PASSWORD'] ?? '');
define("DATABASE", $_ENV['DB_NAME'] ?? 'boosteryard1');
define("ETEGRAM_PROJECT_ID", $_ENV['ETEGRAM_PROJECT_ID'] ?? '');
define("ETEGRAM_PUBLIC_KEY", $_ENV['ETEGRAM_PUBLIC_KEY'] ?? '');
define("ENVIRONMENT", $_ENV['ENVIRONMENT'] ?? 'development');
define("PAYSTACK_PUBLIC_KEY", $_ENV['PAYSTACK_PUBLIC_KEY'] ?? '');

$domain = $_ENV['APP_URL'] ?? 'http://localhost/booster'; // keep a trailing slash in APP_URL

// 5. Database
$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (!$connection) {
    error_log("Database connection failed: " . mysqli_connect_error());
    http_response_code(500);
    die(json_encode(["success" => false, "message" => "Service temporarily unavailable."]));
}
mysqli_set_charset($connection, 'utf8mb4');

// 6. Global Site Variables
$sitename = 'Boost Yard';
$siteemail = 'support@boostyard.com';

$money = '&#36;'; // Dollar sign HTML entity
$toast = '';
$min_crypto_deposit = 5; // Minimum crypto deposit amount