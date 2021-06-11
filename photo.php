<!DOCTYPE html>
<html lang="en">
<?php
    require_once("admin/includes/init.php");
    
    $photo_repo = new PhotoRepository();
    $photo = null;
    if (isset($_GET['id'])) {
        $photo = PhotoFactory::castToPhoto($photo_repo->findById($_GET['id']));
    } else {
        redirect('admin/photos.php');
    }
    
    $comment_repo = new CommentRepository();
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['add-comment']) && isset($post['photo-id'])) {
        $comment = CommentFactory::createNewComment($post['photo-id'], $post['author'], $post['body']);
        $result = $comment_repo->save($comment);
        if (is_string($result)) {
            setMessage($result);
        }
    }
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">PHP Gallery</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="admin">Admin</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading"><?php echo $photo->getTitle(); ?>
                <small><?php echo $photo->getCaption(); ?></small>
            </h4>
            <a class="pull-left" href="photo.php?id=<?php echo $photo->getId(); ?>">
                <img class="media-object photo-thumbnail-post"
                     src="<?php echo UPLOAD_FOLDER . DS . $photo->getFileName(); ?>"
                     alt="<?php echo $photo->getAlternateText(); ?>">
            </a>
            <?php echo $photo->getDescription() ?? ''; ?>
        </div>
    </div>
    <div class="row">
        <?php $comments = $comment_repo->findAllByPhotoId($photo->getId()); ?>
        <?php foreach ($comments as $comment): ?>
            <hr>
            <div class="media">
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment->getAuthor(); ?>
                        <small><?php echo $comment->getCreationDate(); ?></small>
                    </h4>
                    <?php echo $comment->getBody(); ?>
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="post">
                <div class="form-group">
                    <input type="text" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <?php if (Session::getInstance()->isSignedIn()): ?>
                    <a href="admin/photos.php" class="btn btn-primary" role="button">Back to photos</a>
                <?php else: ?>
                    <a href="index.php" class="btn btn-primary" role="button">Back to gallery</a>
                <?php endif; ?>
                <button type="submit" name="add-comment" class="btn btn-primary">Add comment</button>
                <input type="hidden" name="photo-id" value="<?php echo $photo->getId() ?>"/>
            </form>
        </div>
        <hr>
    </div>
</div>
<!-- /.row -->

<hr>

<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">Copyright &copy; Paul Gaida 2021</p>
        </div>
    </div>
    <!-- /.row -->
</footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
