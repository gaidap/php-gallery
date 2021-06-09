<?php require_once("includes/header.php"); ?>
<?php
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['add-comment'])) {
        $repo = new CommentRepository();
        $comment = CommentFactory::createNewComment($post['photo-id'], $post['author'], $post['body']);
        $result = $repo->save($comment);
        if (is_string($result)) {
            setMessage($result);
        } else {
            setMessage("Comment added.");
        }
    }
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add comment
                </h1>
                <form action="add_comment.php" method="post">
                    <div class="col-md-6">
                        <?php
                            if (isMessageSet()) {
                                echo "<div><pre>" . showMessage() . "</pre></div>";
                            }
                        ?>
                        <div class="form-group">
                            <label for="photo-id">Photo:</label>
                            <input id="photo-id" type="text" name="photo-id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input id="author" type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="summernote">Body:</label>
                            <textarea id="summernote" name="body" class="form-control" cols="30" rows="10">
                            </textarea>
                        </div>
                        <a href="comments.php" class="btn btn-primary" role="button">Back to comments</a>
                        <input type="submit" name="add-comment" value="Add comment"
                               class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
