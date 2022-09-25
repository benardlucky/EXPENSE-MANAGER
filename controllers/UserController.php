<?php
//include '../validations/authentication.php';
include(dirname(__DIR__).'/classes/UserClass.php');
$user_class = new UserClass();

if(isset($_POST['action']) && $_POST['action']!="") {
    $action = $_POST['action'];

    switch($action) {

        case 'login_user':
        	$username = $_POST['username'];
        	$password = $_POST['password'];

            $login_user = $user_class->login($username, $password);

        	if($login_user['status']) {
                $_SESSION['is_logged_in'] = true;
                header('Location: index.php');
            	$_SESSION['flash_messages'] = array("message" => $login_user['message'], "category" => "success");
                return;
            }
            else {
            	$_SESSION['flash_messages'] = array("message" => $login_user['message'], "category" => "danger");
                return;
            }

        break;

    }
}