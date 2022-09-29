<?php
$page_title = 'Login';
include 'inc/header.php';
include 'controllers/UserController.php';
?>


<div class="container">
    <form method="POST">

    <?php 
        if(isset($_SESSION['flash_messages']) != "") {
        ?>
        <div class="alert alert-<?php echo $_SESSION['flash_messages']['category']; ?>" role="alert alert-dismissible">
            <center> <?php echo $_SESSION['flash_messages']['message']; ?> </center>
        </div>
        <?php }

        unset($_SESSION['flash_messages']);
    ?>

    <input type="hidden" name="action" value="login_user">
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button class="btn btn-primary">
        Submit
    </button>
    </form>
</div>

<?php
include 'inc/footer.php';
