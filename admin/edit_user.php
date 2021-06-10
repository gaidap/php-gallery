<?php require_once("includes/header.php"); ?>
<?php
    $repo = new UserRepository();
    $user = null;
    if (isset($_GET['id'])) {
        $user = UserFactory::castToUser($repo->findById($_GET['id']));
    } else {
        redirect('users.php');
    }
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['update']) && isset($post['user-id'])) {
        $service = new UserService();
        if ($service->updateUser($post)) {
            redirect('users.php');
        } else {
            redirect('edit_user.php?id=' . $user->getId());
        }
    }
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php require_once("includes/top_nav.php") ?>
    <?php require_once("includes/side_nav.php") ?>
</nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edit User
                </h1>
                <form action="edit_user.php" method="post">
                    <div class="col-md-6">
                        <?php
                            if (isMessageSet()) {
                                echo "<div><pre>" . showMessage() . "</pre></div>";
                            }
                        ?>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input id="username" type="text" name="username" class="form-control"
                                   value="<?php echo $user->getUsername(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="first-name">First name:</label>
                            <input id="first-name" type="text" name="first-name" class="form-control"
                                   value="<?php echo $user->getFirstName(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last name:</label>
                            <input id="last-name" type="text" name="last-name" class="form-control"
                                   value="<?php echo $user->getLastName(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <a href="users.php" class="btn btn-primary" role="button">Back to users</a>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4><?php echo $user->getFirstName() . ' ' . $user->getLastName(); ?> <span id="toggle"
                                                                                                            class="glyphicon glyphicon-menu-up pull-right"></span>
                                </h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Created
                                        on: <?php echo $user->getCreationDate(); ?>
                                    </p>
                                    <p class="text ">
                                        User Id: <span class="data photo_id_box"><?php echo $user->getId(); ?></span>
                                    </p>
                                    <p class="text">
                                        Username: <span class="data"><?php echo $user->getUsername(); ?></span>
                                    </p>
                                    <p class="text">
                                        First name: <span class="data"><?php echo $user->getFirstName(); ?></span>
                                    </p>
                                    <p class="text">
                                        Last name: <span class="data"><?php echo $user->getLastName(); ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a href="delete_user.php?id=<?php echo $user->getId(); ?>"
                                           class="btn btn-danger btn-lg ">Delete user</a>
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update user"
                                               class="btn btn-primary btn-lg ">
                                        <input type="hidden" name="user-id" value="<?php echo $user->getId() ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php require_once("includes/footer.php"); ?>
