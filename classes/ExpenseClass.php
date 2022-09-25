<?php
include(dirname(__DIR__).'/config/database.php');
include(dirname(__DIR__).'/validations/expenses.php');

class ExpenseClass
{

	function __construct()
	{
		$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		if(mysqli_connect_errno()) {
			echo "Error: Could not connect to atabase";
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
}
