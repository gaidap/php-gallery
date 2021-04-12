<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Administration
                <small>PHP-Gallery administration</small>
            </h1>
            <?php
                $database = new Database();
                $user_repository = new UserRepository($database->getConnection());
                foreach ($user_repository->listUsers() as $user) {
                    echo $user . "\n";
                }
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
