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
                    Photos
                </h1>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Creation date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $repo = new PhotoRepository();
                            $photos = $repo->findAll();
                            foreach ($photos as $photo) {
                                echo "<td><img class='admin-photo-thumbnail-list' src=' " . $photo->getRelativePath() . "' alt='" . $photo->getAlternateText() . "'>\n"
                                    . "<div>\n"
                                    . "<a class='preview-btn' href='view.php?id=" . $photo->getId() . "'>View</a>"
                                    . "<a class='preview-btn' href='edit.php?id=" . $photo->getId() . "'>Edit</a>"
                                    . "<a class='preview-btn' href='delete.php?id=" . $photo->getId() . "'>Delete</a>"
                                    . "</div>\n"
                                    . "</td>\n"
                                    . "<td>" . $photo->getId() . "</td>\n"
                                    . "<td>" . $photo->getTitle() . "</td>\n"
                                    . "<td>" . $photo->getType() . "</td>\n"
                                    . "<td>" . $photo->getSize() . "</td>\n"
                                    . "<td>" . $photo->getCreationDate() . "</td>\n";
                            }
                        ?>
                        </tbody>
                    </table> <!--End of Table-->
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php require_once("includes/footer.php"); ?>
