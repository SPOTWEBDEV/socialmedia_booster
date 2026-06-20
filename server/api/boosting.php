<?php

// 2. Load environment config & core class blueprints
require_once '../connection.php';
require_once '../controller/boosting.php'; 

// 3. Hydrate the API object instance with your global secure variable
$api = new Api($api_key);

// 4. Query services telemetry from your provider
$services = $api->services();

// 5. Output cleanly structured JSON payload back to the client interface
header('Content-Type: application/json');
echo json_encode($services);
?>