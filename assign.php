<?php
session_start();

$_SESSION['start_value'] = $_POST['start'];
$_SESSION['end_value'] = $_POST['end'];
$_SESSION['number'] = $_POST['number'];

header("Location: index.php"); /* Redirect browser */
exit();
?>