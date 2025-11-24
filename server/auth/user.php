<?php
$url = $domain . 'auth/login/';

function formatNumber($number)
{
    return number_format($number, 2, '.', ',');
}


function sanitize($value, $default = 'None') {
    return empty(trim($value)) ? $default : $value;
}



if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $id = $_SESSION['user_id'];
    $select = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`=$id");
    if (mysqli_num_rows($select)) {
        while ($row = mysqli_fetch_assoc($select)) {
            $email            = sanitize($row['email']);
            $fullname         = sanitize($row['fullname']);
        }
    } else {
        echo "<script>window.open('$url', '_self');</script>";
    }
} else {
    echo "<script>window.open('$url', '_self');</script>";
}



if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    echo "<script>window.open('$url', '_self');</script>";
}















if ($status === 'suspended' && !empty($status_message)) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Account Suspended',
                html: `" . addslashes($status_message) . "`,
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        });
    </script>";
}
