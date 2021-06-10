<?php require_once("includes/header.php"); ?>

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
                    Users
                </h1>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Creation date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $repo = new UserRepository();
                            $users = $repo->findAll();
                            foreach ($users as $user) {
                                $id = $user->getId();
                                echo "<tr><td>"
                                    . "<a href='edit_user.php?id=" . $id . "'>" . $id . "</a>"
                                    . "<div class='list-action-btn-wrapper'>\n"
                                    . "<a class='preview-btn' href='delete_user.php?id=" . $user->getId() . "'>Delete</a>"
                                    . "</div>\n"
                                    . "</td>\n"
                                    . "<td><a href='edit_user.php?id=" . $id . "'>" . $user->getUsername() . "</a></td>\n"
                                    . "<td><a href='edit_user.php?id=" . $id . "'>" . $user->getFirstName() . "</a></td>\n"
                                    . "<td><a href='edit_user.php?id=" . $id . "'>" . $user->getLastName() . "</a></td>\n"
                                    . "<td><a href='edit_user.php?id=" . $id . "'>" . $user->getCreationDate() . "</a></td></tr>\n";
                            }
                        ?>
                        </tbody>
                    </table> <!--End of Table-->
                </div>
                <a href="register.php" class="btn btn-primary">Add user</a>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    
    <?php require_once("includes/footer.php"); ?>
