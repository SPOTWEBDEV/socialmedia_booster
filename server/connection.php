<?php

// Start session safely if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


$projectRoot = dirname(__DIR__);

// 2. Load Composer Autoloader using the absolute path
if (file_exists($projectRoot . '/vendor/autoload.php')) {
    require_once $projectRoot . '/vendor/autoload.php';

    // 3. Initialize and load environment variables safely
    $dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
    $dotenv->load();
} else {
    die(json_encode([
        "success" => false,
        "message" => "Critical Error: Vendor autoloader not found. Run 'composer install'."
    ]));
}

// 4. Assign environment values with safe fallbacks
$api_key = $_ENV['BOOSTING_KEY'];
define("HOST", $_ENV['DB_HOST'] ?? 'localhost');
define("USER", $_ENV['DB_USER'] ?? 'root');
define("PASSWORD", $_ENV['DB_PASSWORD'] ?? '');
define("DATABASE", $_ENV['DB_NAME'] ?? 'boosteryard1');
define("ETEGRAM_PROJECT_ID", $_ENV['ETEGRAM_PROJECT_ID'] ?? '');
define("ETEGRAM_API_KEY", $_ENV['ETEGRAM_API_KEY'] ?? '');
define("ENVIRONMENT", $_ENV['ENVIRONMENT'] ?? 'development');
define("PAYSTACK_PUBLIC_KEY", $_ENV['PAYSTACK_PUBLIC_KEY'] ?? '');


if (ENVIRONMENT === 'production') {
    $domain = "https://boostyard.com.yahhh44.com/";
} else {
    $domain = "http://localhost/booster/";
}


$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (!$connection) {
    die(json_encode([
        "success" => false,
        "message" => "Database connection failed: " . mysqli_connect_error()
    ]));
}



// 6. Global Site Variables
$sitename = 'Boost Yard';
$siteemail = 'support@boostyard.com';

$money = '&#36;'; // Dollar sign HTML entity
$toast = '';
$min_crypto_deposit = 5; // Minimum crypto deposit amount
