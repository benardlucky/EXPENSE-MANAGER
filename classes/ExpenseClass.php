<?php
include(dirname(__DIR__).'/config/database.php');
include(dirname(__DIR__).'/validations/expenses.php');

class ExpenseClass
{

	function __construct()
	{
		$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		if(mysqli_connect_errno()) {
			echo "Error: Could not connect to database";
			exit;
		}
	}

    public function addExpense($merchant, $amount, $date, $comment, $receipt) {

        $is_validated = validateExpenses($merchant, $amount, $date, $comment);
        
        if(!$is_validated['status']) {
            return $is_validated;
        }
        //insert into table
        $insert = mysqli_query($this->db, "INSERT INTO expenses(merchant, amount, date, comment, status, receipt) VALUES('$merchant', '$amount', '$date', '$comment', 'in_progess', '$receipt')");

        if($insert) {
            return [
                'status' => true,
                'message' => 'Expenses added successfully'
            ];
        }
        return [
            'status' => false,
            'message' => 'Failed to add expenses'
        ];
    }

    public function getAllExpenses() {
        $sql = "SELECT * FROM expenses ORDER BY id DESC";
		$res = mysqli_query($this->db, $sql);

		$row = mysqli_num_rows($res);

		$all_expenses = array();
		$data = array();

		if($res) {
			while($row_array = mysqli_fetch_array($res)) {
				$all_expenses[] = $row_array;
				$data = array('message' => $all_expenses);
			}
			return $data;
		}
    }

    public function filterExpenses($from_date, $to_date, $min_amount, $max_amount, $merchant) {
        if(!$to_date) {
            $to_date = date('Y-m-d'); //get current date
        }
        $is_min_amount = ($min_amount) ? " amount >= '$min_amount' AND " : "";
        $is_max_amount = ($max_amount) ? " amount <= '$max_amount' AND " : "";
        $is_merchant = ($merchant) ? " merchant = '$merchant' AND " : "";
        $sql = "SELECT * FROM expenses WHERE" . $is_min_amount . "" . $is_max_amount . "" . $is_merchant . " date BETWEEN '$from_date' AND '$to_date' ORDER BY id DESC";
		$res = mysqli_query($this->db, $sql);

		$row = mysqli_num_rows($res);

		$all_expenses = array();
		$data = array();

		if($res) {
			while($row_array = mysqli_fetch_array($res)) {
				$all_expenses[] = $row_array;
				$data = array('message' => $all_expenses);
			}
            $_SESSION['filtered'] = true;
            $_SESSION['all_expenses'] = $data;
			return $data;
		}
    }
    public function update_expenses($merchant, $amount, $date, $comment, $receipt) {

       
        //update table//
        $id = $_GET['id'] ?? null;

        if (!$id){

        header('location: index.php');
        exit;
        }

        $update_row = mysqli_query($this->db, "SELECT * FROM expenses WHERE(id = :id) VALUES('id', $id)");
        

        $merchant = $update_row['merchant'];
        $amount = $update_row['amount'];
        $comment = $update_row['comment'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        
        $is_validated = validateExpenses($merchant, $amount, $date, $comment);
        
        if(!$is_validated['status']) {
            return $is_validated;
        }
        if($update_row) {
            return [
                'status' => true,
                'message' => 'Expenses Updated successfully'
            ];
        }
        return [
            'status' => false,
            'message' => 'Failed to add expenses'
        ];
    }
}
