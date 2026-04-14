<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

if(isset($_SESSION['user_id'])) {
    session_destroy();
    header('Location: ../../auth/login');
}


?>