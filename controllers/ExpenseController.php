<?php
//include '../validations/authentication.php';
include(dirname(__DIR__).'/classes/ExpenseClass.php');
$expense_class = new ExpenseClass();

if(isset($_POST['action']) && $_POST['action']!="") {
    $action = $_POST['action'];

    switch($action) {

        case 'add_expense':
        	$merchant = $_POST['merchant'];
        	$amount = $_POST['amount'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];
            $receipt = '';

            if($_FILES['receipt']) {
                $receipt = $_FILES['receipt']['name'];
                $receipt = time().$receipt;
                $img2 = 'img/'.$receipt;
                $target2 = "img/".basename($receipt);
                move_uploaded_file($_FILES['receipt']['tmp_name'], $target2);
            }

            $add_new_expense = $expense_class->addExpense($merchant, $amount, $date, $comment, $receipt);

        	if($add_new_expense['status']) {
            	$_SESSION['flash_messages'] = array("message" => $add_new_expense['message'], "category" => "success");
                return;
            }
            else {
            	$_SESSION['flash_messages'] = array("message" => $add_new_expense['message'], "category" => "danger");
                return;
            }

        break;

    }
}