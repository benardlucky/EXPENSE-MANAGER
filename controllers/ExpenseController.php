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


            $target_dir = dirname(__DIR__).'/public/images/expenses/';
            $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["receipt"]["tmp_name"]);
            }

            if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["receipt"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            if($_FILES['receipt']) {
                
                $receipt = $_FILES['receipt']['name'];
                $receipt = time().$receipt;
                $img2 = 'public/images/expenses'.$receipt;
                $target2 = "public/images/expenses".basename($receipt);
                move_uploaded_file($_FILES['receipt']['tmp_name'], $target2);
            }

            $add_new_expense = $expense_class->addExpense($merchant, $amount, $date, $comment, $receipt);

        	if($add_new_expense['status']) {
            	$_SESSION['flash_messages'] = array("message" => $add_new_expense['message'], "category" => "success");
                return;
            }
            else {
            	$_SESSION['flash_messages'] = array("message" => $receipt, "category" => "danger");
                return;
            }

        break;

        case "filter_expenses":
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $min_amount = $_POST['min_amount'];
            $max_amount = $_POST['max_amount'];
            $merchant = $_POST['merchant'];

            $filter = $expense_class->filterExpenses($from_date, $to_date, $min_amount, $max_amount, $merchant);
            $_SESSION['flash_messages'] = array("message" => "Filtered results", "category" => "success");
            return;
        break;
        
        case "update_expenses":
            $merchant = $_POST['merchant'];
        	$amount = $_POST['amount'];
            $comment = $_POST['comment'];
            $receipt = '';


            $target_dir = dirname(__DIR__).'/public/images/expenses/';
            $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["receipt"]["tmp_name"]);
            }

            if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["receipt"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            if($_FILES['receipt']) {
                
                $receipt = $_FILES['receipt']['name'];
                $receipt = time().$receipt;
                $img2 = 'public/images/expenses'.$receipt;
                $target2 = "public/images/expenses".basename($receipt);
                move_uploaded_file($_FILES['receipt']['tmp_name'], $target2);
            }

            $update_expense = $expense_class->update_expenses($merchant, $amount, $date, $comment, $receipt);

        	if($update_expense['status']) {
            	$_SESSION['flash_messages'] = array("message" => $update_expense['message'], "category" => "success");
                return;
            }
            else {
            	$_SESSION['flash_messages'] = array("message" => $update_expense, "category" => "danger");
                return;
            }

        break;


    }
}