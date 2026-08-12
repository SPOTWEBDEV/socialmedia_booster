<?php

$url = $domain . 'admin/login/';
session_destroy();

echo "<script>window.open('$url', '_self');</script>";


?>