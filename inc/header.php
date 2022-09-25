<?php
session_start();
include 'config/constant.php';
if(!$_SESSION['is_logged_in'] && basename($_SERVER['PHP_SELF']) != 'login.php')  {
    header('Location: logout.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $constants['app_name']; ?>  - <?php echo $page_title; ?></title>

    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    