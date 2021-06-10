<?php require_once("includes/header.php"); ?>
<?php
    $repo = new CommentRepository();
    $comment = null;
    if (isset($_GET['id'])) {
        $comment = CommentFactory::castToComment($repo->findById($_GET['id']));
    } else {
        redirect('comments.php');
    }
    
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['update-comment']) && isset($post['comment-id'])) {
        $service = new CommentService();
        if ($service->updateComment($post)) {
            redirect('comments.php');
        } else {
            redirect('edit_comment.php?id=' . $comment->getId());
        }
    }
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edit comment
                </h1>
                <form action="edit_comment.php" method="post">
                    <div class="col-md-6">
                        <?php
                            if (isMessageSet()) {
                                echo "<div><pre>" . showMessage() . "</pre></div>";
                            }
                        ?>
                        <div class="form-group">
                            <label for="photo-id">Photo:</label>
                            <input id="photo-id" type="text" name="photo-id" class="form-control"
                                   value="<?php echo $comment->getPhotoId(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input id="author" type="text" name="author" class="form-control"
                                   value="<?php echo $comment->getAuthor(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea id="body" name="body" class="form-control" cols="30" rows="10">
                                <?php echo $comment->getBody(); ?>
                            </textarea>
                        </div>
                        <a href="comments.php" class="btn btn-primary" role="button">Back to comments</a>
                        <input type="submit" name="update-comment" value="Update comment"
                               class="btn btn-primary">
                        <a href="delete_comment.php?id=<?php echo $comment->getId(); ?>" class="btn btn-danger"
                           role="button">Delete comment</a>
                        <input type="hidden" name="comment-id" value="<?php echo $comment->getId(); ?>"/>
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
