<?php
$url = $domain . 'admin/login/';

if (isset($_SESSION['admin_']) && $_SESSION['admin_'] != "") {
    $id = $_SESSION['admin_'];
    $select = mysqli_query($connection, "SELECT * FROM `admin` WHERE `id`=$id");
    if (mysqli_num_rows($select)) {
    } else {
        echo "<script>window.open('$url', '_self');</script>";
    }
} else {
    echo "<script>window.open('$url', '_self');</script>";
}



if (isset($_GET['logout']) && $_GET['logout'] == 'true' && isset($_SESSION['admin_'])) {
    session_destroy();
    echo "<script>window.open('$url', '_self');</script>";
}
