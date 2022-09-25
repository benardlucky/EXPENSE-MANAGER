<?php
$page_title = 'Home';
include 'inc/header.php';
include 'controllers/ExpenseController.php';
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

<div class="form">
    <form method="POST">
        <input type="hidden" name="action" value="add_expense">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Merchant</label>
                    <select name="merchant" id="" class="form-control">
                        <option value="taxi">Taxi</option>
                        <option value="parking">Parking</option>
                        <option value="breakfast">Breakfast</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Total</label>
                    <input type="text" class="form-control" name="amount">
                </div>

                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control" name="date">
                </div>

                <div class="form-group">
                    <label for="">Comment</label>
                    <textarea class="form-control" name="comment"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Receipt</label>
                    <input type="file" class="form-control" name="receipt">
                </div>
            </div>
        </div>

        <button class="btn btn-primary col-md-6">Submit</button>
        
    </form>
</div>