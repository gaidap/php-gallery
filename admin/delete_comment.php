<?php require_once("includes/header.php"); ?>
<?php
    $repo = new CommentRepository();
    $comment = null;
    if (isset($_GET['id'])) {
        $comment = $repo->findById($_GET['id']);
        if (!$comment) {
            setMessage('Comment not exists.');
        }
        $result = $repo->delete($comment);
        if (is_string($result)) {
            setMessage($result);
        } else {
            setMessage('Comment deleted successful.');
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
                    Delete Comment
                </h1>
                <div class="col-md-6">
                    <?php
                        if (isMessageSet()) {
                            echo "<div><pre>" . showMessage() . "</pre></div>";
                        }
                    ?>
                    <a href="comments.php?id=<?php echo $comment->getPhotoId(); ?>" class="btn btn-primary" role="button">Back
                        to comments</a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php require_once("includes/footer.php"); ?>
