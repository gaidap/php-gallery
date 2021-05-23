<?php require_once("includes/header.php"); ?>
<?php
    $repo = new PhotoRepository();
    $photo = null;
    if (isset($_GET['id'])) {
        $photo = PhotoFactory::castToPhoto($repo->findById($_GET['id']));
    } else {
        redirect('photos.php');
    }
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['update']) && isset($post['photo_id'])) {
        $service = new PhotoService();
        if ($service->updatePhoto($post)) {
            redirect('photos.php');
        } else {
            redirect('edit.php?id=' . $photo->getId());
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
                    Edit Photo
                </h1>
                <form action="edit.php" method="post">
                    <div class="col-md-6">
                        <?php
                            if (isMessageSet()) {
                                echo "<div><pre>" . showMessage() . "</pre></div>";
                            }
                        ?>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input id="title" type="text" name="title" class="form-control"
                                   value="<?php echo $photo->getTitle(); ?>"><br><br>
                        </div>
                        <div class="form-group">
                            <a class="thumbnail" href="view.php?id=<?php echo $photo->getId(); ?>">
                                <img class="admin-photo-thumbnail-edit" src="<?php echo $photo->getRelativePath() ?>"
                                     alt="<?php echo $photo->getAlternateText() ?>">
                            </a>
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption:</label>
                            <input id="caption" type="text" name="caption" class="form-control"
                                   value="<?php echo $photo->getCaption() ?? ''; ?>"><br><br>
                        </div>
                        <div class="form-group">
                            <label for="alternate-text">Alternate text:</label>
                            <input id="alternate-text" type="text" name="alternate-text" class="form-control"
                                   value="<?php echo $photo->getAlternateText(); ?>"><br><br>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Description:</label>
                            <textarea id="summernote" name="description" class="form-control" cols="30" rows="10">
                                <?php echo $photo->getDescription() ?? ''; ?>
                            </textarea><br><br>
                        </div>
                        <a href="photos.php" class="btn btn-primary" role="button">Back to photos</a>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4><?php echo $photo->getTitle(); ?> <span id="toggle"
                                                                            class="glyphicon glyphicon-menu-up pull-right"></span>
                                </h4>
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
                                        <input type="hidden" name="photo_id" value="<?php echo $photo->getId() ?>"/>
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
