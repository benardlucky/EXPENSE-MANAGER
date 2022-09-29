<?php
$page_title = 'Home';
include 'inc/header.php';
include_once 'controllers/ExpenseController.php';
include_once 'classes/ExpenseClass.php';
$expense_class = new ExpenseClass();
$all_expenses = (isset($_SESSION['filtered']) === true) ? $_SESSION['all_expenses'] : $expense_class->getAllExpenses();
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

<div class="row">
    <div class="col-md-3">
        <h6>Filter Expenses</h6>
        <hr>
        <div class="form">
            <form method="POST">
                <input type="hidden" name="action" value="filter_expenses">
                <div class="form-group">
                    <label for="">From</label>
                    <input type="date" class="form-control" name="from_date">
                </div>

                <div class="form-group">
                    <label for="">To</label>
                    <input type="date" class="form-control" name="to_date">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Min.</label>
                            <input type="text" class="form-control" name="min_amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Max.</label>
                            <input type="text" class="form-control" name="max_amount">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Merchant</label>
                    <select name="merchant" id="" class="form-control">
                        <option value="taxi">Taxi</option>
                        <option value="parking">Parking</option>
                        <option value="breakfast">Breakfast</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">Status</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="checkbox" class="" name="status" value="new">
                            <label for="">New</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" class="" name="status" value="in_progress">
                            <label for="">In Progress</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" class="" name="status" value="reimbursed">
                            <label for="">Reimbursed</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block">Filter</button>
            </form>
        </div>
    </div>
    <div class="col-md-6">

<!-- Modal -->
<div class="modal fade" id="add_new_expenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form">
            <form method="POST">
                <input type="hidden" name="action" value="add_expense">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Merchant</label>
                            <select name="merchant" id="" class="form-control">
                                <option value="taxi">Taxi</option>
                                <option value="parking">Parking</option>
                                <option value="breakfast">Breakfast</option>
                                <option value="luanch">luanch</option>
                                <option value="breakfast">stationary</option>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <div class="table-responsive" style="height: 100vh;">
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
                                        <td><a type="button" class="btn btn-white" data-toggle="modal" data-target="#view_expenses_<?php echo $expense['id']; ?>"><?php echo $expense['date']; ?></a></td>	
                                        <td><?php echo $expense['merchant']; ?></td>
                                        <td><?php echo $expense['amount']; ?></td>
                                        <td><?php echo $expense['status']; ?></td>
                                        <td><?php echo $expense['comment']; ?></td>

                                        <div class="modal fade" id="view_expenses_<?php echo $expense['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Expense</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form">
                                                    <form method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="action" value="edit_expense">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Merchant</label>
                                                                    <select name="merchant" id="" class="form-control">
                                                                        <option value="taxi" <?php if($expense['merchant'] == 'taxi') { ?> selected <?php } ?>>Taxi</option>
                                                                        <option value="parking" <?php if($expense['merchant'] == 'parking') { ?> selected <?php } ?>>Parking</option>
                                                                        <option value="breakfast" <?php if($expense['merchant'] == 'breakfast') { ?> selected <?php } ?>>Breakfast</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Total</label>
                                                                    <input type="text" class="form-control" name="amount" value="<?php echo $expense['amount'];?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Date</label>
                                                                    <input type="date" class="form-control" name="date" value="<?php echo $expense['date'];?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">Comment</label>
                                                                    <textarea class="form-control" name="comment"><?php echo $expense['comment'];?></textarea>
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
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </tr>
                                <?php }
                            }
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>

<div class="fab-container">
  <div class="fab shadow">
    <div class="fab-content">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_new_expenses">
        Add
    </button>
    </div>
  </div>
</div>

<?php
    unset($_SESSION['filtered']);
?>