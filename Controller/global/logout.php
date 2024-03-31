<?php
session_start();
session_destroy();
header('location: ../../View/Admin/login.php');

?>