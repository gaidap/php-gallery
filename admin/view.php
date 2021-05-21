<?php require_once("includes/header.php"); ?>
<?php
    $photo = null;
    if (isset($_GET['id'])) {
        $repo = new PhotoRepository();
        $photo = PhotoFactory::castToPhoto($repo->findById($_GET['id']));
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
                    <img src="<?php echo $photo?->getRelativePath() ?? 'NO FILE'; ?>"
                         alt="<?php echo $photo?->getAlternateText() ?? 'NO FILE'; ?>">
                    <a href="photos.php" class="btn btn-primary" role="button">Back to photos</a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php require_once("includes/footer.php"); ?>
