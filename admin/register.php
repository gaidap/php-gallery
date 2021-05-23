<?php require_once("includes/header.php"); ?>
<?php
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['register'])) {
        $repo = new UserRepository();
        $user = UserFactory::createNewUser($post['username'], $post['password'], $post['first-name'], $post['last-name']);
        $result = $repo->save($user);
        if (is_string($result)) {
            setMessage($result);
        } else {
            redirect("login.php");
        }
    }
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Register User
                </h1>
                <form action="register.php" method="post">
                    <div class="col-md-6">
                        <?php
                            if (isMessageSet()) {
                                echo "<div><pre>" . showMessage() . "</pre></div>";
                            }
                        ?>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input id="username" type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="first-name">First name:</label>
                            <input id="first-name" type="text" name="first-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last name:</label>
                            <input id="last-name" type="text" name="last-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <a href="login.php" class="btn btn-primary" role="button">Back to login</a>
                        <input type="submit" name="register" value="Register"
                               class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
