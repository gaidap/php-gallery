<?php
    require_once("includes/header.php");
    
    $repo = new PhotoRepository();
    $page = new Pagination($repo->countAll(), $_GET['page'] ?? 1);
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
        <div class="row">
            <ul class="pager">
                <?php if ($page->hasPreviousPage()): ?>
                    <li class="previous"><a
                                href="index.php?page=<?php echo $page->getCurrentPage() - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $page->calculateTotalPageCount(); $i++): ?>
                    <li class="<?php echo $i == $page->getCurrentPage() ? 'active' : ''; ?>"><a
                                href="<?php echo 'index.php?page=' . $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page->hasNextPage()): ?>
                    <li class="next"><a href="index.php?page=<?php echo $page->getCurrentPage() + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
            <ul class="pager">
                <?php if ($page->hasPreviousPage() || $page->hasNextPage()): ?>
                    <li><a><?php echo $page->getCurrentPage() ?> of <?php echo $page->calculateTotalPageCount(); ?> </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- /.row -->
<?php require_once("includes/footer.php"); ?>
