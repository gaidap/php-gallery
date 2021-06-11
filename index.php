<?php
    require_once("includes/header.php");
    
    $repo = new PhotoRepository();
    
    $page = new Pagination($repo->countAll(), $_GET['offset'] ?? 0);
    $photos = $repo->fetchPage($page);

?>

<h1>My super awesome gallery website!</h1>
<hr>
<div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php foreach ($photos as $photo): ?>
                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?php echo $photo->getId(); ?>">
                        <img class="img-responsive gallery-photo"
                             src="<?php echo UPLOAD_FOLDER . DS . $photo->getFileName(); ?>"
                             alt="<?php echo $photo->getAlternateText(); ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- /.row -->
<?php require_once("includes/footer.php"); ?>
