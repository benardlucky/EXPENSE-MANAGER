<?php
session_start();
include 'config/constant.php';
if(!isset($_SESSION['is_logged_in']) && basename($_SERVER['PHP_SELF']) != 'login.php')  {
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
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-nav">
        <a class="navbar-brand header-logo" href="#">Expense Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            
            </ul>
            <button class="btn btn-outline-primary my-2 nav-bt" type="submit">INFO</button>
            <a href="logout.php" class="btn btn-outline-primary my-2 nav-bt" type="submit">LOGOUT</a>
        </div>
    </nav>

    <div class="container-fluid main-body">
    