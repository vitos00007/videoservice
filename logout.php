<?php
session_start();
include("path.php");

unset($_SESSION['id']);
unset($_SESSION['nickname']);
unset($_SESSION['admin']);

header('location: ' . BASE_URL);
?>