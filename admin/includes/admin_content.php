<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Administration
                <small>PHP-Gallery administration</small>
            </h1>
            <?php
                $user_repo = new UserRepository();
                $user  = UserFactory::createNewUser('robin', '1234', 'Robin', 'Gaida');
                $user_repo->save($user);
                $robin = $user_repo->findByUsername('robin');
                $robin->setFirstName('Robin Antonio');
                $user_repo->save($robin);
                $user_repo->delete($robin);
            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
