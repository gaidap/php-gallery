<?php require_once("includes/header.php"); ?>
<?php
    $photo = null;
    if (isset($_GET['id'])) {
        $repo = new PhotoRepository();
        $photo = PhotoFactory::castToPhoto($repo->findById($_GET['id']));
    }
    if (isset($_POST['id'])) {
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
                    Edit Photo
                </h1>
                <form action="edit.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label>Caption:</label>
                            <input type="text" name="caption" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label>Alternate text:</label>
                            <input type="text" name="alternate-text" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" class="form-control" cols="30" rows="10"></textarea><br><br>
                        </div>
                        <a href="photos.php" class="btn btn-primary" role="button">Back to photos</a>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Uploaded
                                        on: <?php echo $photo->getCreationDate(); ?>
                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?php echo $photo->getId(); ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photo->getFileName(); ?></span>
                                    </p>
                                    <p class="text">
                                        File Type: <span class="data"><?php echo $photo->getType(); ?></span>
                                    </p>
                                    <p class="text">
                                        File Size: <span class="data"><?php echo $photo->getSize(); ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a href="delete.php?id=<?php echo $photo->getId(); ?>"
                                           class="btn btn-danger btn-lg ">Delete</a>
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update"
                                               class="btn btn-primary btn-lg ">
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
