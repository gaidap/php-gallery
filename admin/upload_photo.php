<?php require_once("includes/header.php"); ?>
<?php
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['submit_upload'])) {
        $service = new PhotoService();
        $service->savePhotoFile($_FILES['file_upload'], $post['title']);
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
                    <form action="upload_photo.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <?php
                                if (isMessageSet()) {
                                    echo "<div><pre>" . showMessage() . "</pre></div>";
                                }
                            ?>
                            <label>Title:</label><br>
                            <input type="text" name="title"><br><br>
                            <label>Select a file...</label><br>
                            <input type="file" name="file_upload"><br><br>
                            <input type="submit" name="submit_upload" value="Upload">
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
