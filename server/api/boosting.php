<?php
require '../controller/boosting.php'; // include your API class

$services = $api->services();

header('Content-Type: application/json');
echo json_encode($services);
