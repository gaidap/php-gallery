<?php require_once("includes/header.php"); ?>
<?php
    if (Session::getInstance()->isSignedIn()) {
        redirect("index.php");
    }
    
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['submit'])) {
        Session::getInstance()->signIn($post['username'], $post['password']);
    } else {
        unset($post);
    }
?>

<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo showMessage(); ?></h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <a href="register.php" class="btn btn-primary">Register</a>
        </div>

    </form>


</div>
