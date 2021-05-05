<?php require_once("includes/header.php"); ?>
<?php
    if (isset($_GET['id'])) {
        $service = new PhotoService();
        $service->deletePhotoFile($_GET['id']);
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
                    Upload Section
                </h1>
                <div class="col-md-6">
                    <form action="upload.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <?php
                                if (isMessageSet()) {
                                    echo "<div><pre>" . showMessage() . "</pre></div>";
                                }
                            ?>
                            <a href="photos.php" class="btn btn-primary" role="button">Back to photos</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php require_once("includes/footer.php"); ?>
