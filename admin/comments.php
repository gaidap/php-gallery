<?php require_once("includes/header.php"); ?>

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
                    Comments
                </h1>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo ID</th>
                            <th>Author</th>
                            <th>Body</th>
                            <th>Creation date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $photo_repo = new PhotoRepository();
                            $photo = null;
                            if (isset($_GET['id'])) {
                                $photo = PhotoFactory::castToPhoto($photo_repo->findById($_GET['id']));
                            }
                            $comment_repo = new CommentRepository();
                            $comments = $photo == null ? $comment_repo->findAll() : $comment_repo->findAllByPhotoId($photo->getId());
                            foreach ($comments as $comment) {
                                $id = $comment->getId();
                                echo "<tr><td>"
                                    . "<a href='edit_comment.php?id=" . $id . "'>" . $id . "</a>"
                                    . "<div class='list-action-btn-wrapper'>\n"
                                    . "<a class='preview-btn' href='delete_comment.php?id=" . $comment->getId() . "'>Delete</a>"
                                    . "</div>\n"
                                    . "</td>\n"
                                    . "<td><a href='edit_comment.php?id=" . $id . "'>" . $comment->getPhotoId() . "</a></td>\n"
                                    . "<td><a href='edit_comment.php?id=" . $id . "'>" . $comment->getAuthor() . "</a></td>\n"
                                    . "<td><a href='edit_comment.php?id=" . $id . "'>" . $comment->getBody() . "</a></td>\n"
                                    . "<td><a href='edit_comment.php?id=" . $id . "'>" . $comment->getCreationDate() . "</a></td></tr>\n";
                            }
                        ?>
                        </tbody>
                    </table> <!--End of Table-->
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    
    <?php require_once("includes/footer.php"); ?>
