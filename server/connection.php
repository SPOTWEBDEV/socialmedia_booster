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
$api_key = $_ENV['BOOSTING_KEY'] ?? $_SERVER['BOOSTING_KEY'] ?? '';



// Helper function to check URL schema
function checkUrlProtocol($url)
{
    $parsedUrl = parse_url($url);
    return isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] : 'invalid';
}

// Automatically construct the current execution URL
$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '');

// Get the protocol from the current URL
$request = checkUrlProtocol($currentUrl);

// Default configurations safely protected from re-definition crashes
if (!defined("HOST")) {
    define("HOST", "localhost");
}

// Determine environment context safely
$isLocalhost = (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1'));

// 5. Environment Routing (Database Connections & Domains)
if ($isLocalhost) {
    // Offline (Localhost Environment)
    $domain = "http://localhost/booster/";

    if (!defined("USER")) define("USER", "root");
    if (!defined("PASSWORD")) define("PASSWORD", "");
    if (!defined("DATABASE")) define("DATABASE", "boosteryard1");

    // Connect to local database using global check to avoid redundant link mutations
    if (!isset($connection)) {
        $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        if (!$connection) {
            die(json_encode([
                "success" => false, 
                "message" => "Local database connection failed: " . mysqli_connect_error()
            ]));
        }
    }
} else {
    // Online (Live Production Server)
    $domain = "https://boostyard.com.yahhh44.com/";

    if (!defined("USER")) define("USER", "yahhhcom_boostyard");
    if (!defined("PASSWORD")) define("PASSWORD", "yahhhcom_boostyard");
    if (!defined("DATABASE")) define("DATABASE", "yahhhcom_boostyard");

    // Connect to production database
    if (!isset($connection)) {
        $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        if (!$connection) {
            die(json_encode([
                "success" => false, 
                "message" => "Production database connection failed: " . mysqli_connect_error()
            ]));
        }
    }
}

// 6. Global Site Variables
$sitename = 'Boost Yard';
$siteemail = 'support@boostyard.com';

$money = '&#36;'; // Dollar sign HTML entity
$toast = '';
$paystack_secret = "sk_test_d4e4ff7576d171cf3f51419738023c6b1ca0bd6e"; // Replace with your live key when ready
$min_crypto_deposit = 5; // Minimum crypto deposit amount

?>