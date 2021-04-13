<?php
    require_once("includes/header.php");
    
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
        redirect("index.php");
    }
    
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $error_message = "";
    if (isset($_POST['submit'])) {
        $database = new Database();
        $user_repo = new UserRepository($database->getConnection());
        $current_user = $user_repo->verifyUser($post['username'], $post['password']);
        if ($current_user) {
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_data'] = array(
                "id" => $current_user->getId(),
                "username" => $current_user->getUsername()
            );
            redirect("index.php");
        } else {
            $error_message = "Invalid password or username";
        }
    } else {
        unset($post);
    }
?>

<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger"><?php echo $error_message; ?></h4>

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

        </div>


    </form>


</div>
