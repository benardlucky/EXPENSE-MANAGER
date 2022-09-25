<?php
$page_title = 'Home';
include 'inc/header.php';
include 'classes/ExpenseClass.php';
$expense_class = new ExpenseClass();
$all_expenses = $expense_class->getAllExpenses();
?>

<?php 
    if(isset($_SESSION['flash_messages']) != "") {
    ?>
    <div class="alert alert-<?php echo $_SESSION['flash_messages']['category']; ?>" role="alert alert-dismissible">
        <center> <?php echo $_SESSION['flash_messages']['message']; ?> </center>
    </div>
    <?php }

    unset($_SESSION['flash_messages']);
?>

<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Merchant</th>
                <th>Total</th>
                <th>Status</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($all_expenses != '') {
                    foreach($all_expenses as $list) { 
                        foreach ($list as $expense) { ?>
                            <tr>
                                <td><?php echo $expense['date']; ?></td>	
                                <td><?php echo $expense['merchant']; ?></td>
                                <td><?php echo $expense['amount']; ?></td>
                                <td><?php echo $expense['status']; ?></td>
                                <td><?php echo $expense['comment']; ?></td>									
                            </tr>
                        <?php }
                    }
                } 
            ?>
        </tbody>
    </table>
</div>