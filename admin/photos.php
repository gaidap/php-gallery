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
                            <th>Preview</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $repo = new PhotoRepository();
                            $photos = $repo->findAll();
                            foreach ($photos as $photo) {
                                echo "<td><a href='delete.php?id=" . $photo->getId() . "' class='btn btn-danger btn-sm' role='button'>x</a></td>\n"
                                    . "<td>" . $photo->getId() . "</td>\n"
                                    . "<td>" . $photo->getTitle() . "</td>\n"
                                    . "<td>" . $photo->getType() . "</td>\n"
                                    . "<td>" . $photo->getSize() . "</td>\n"
                                    . "<td>" . $photo->getCreationDate() . "</td>\n"
                                    . "<td><img src=' " . $photo->getRelativePath() . "' alt='" . $photo->getFileName()
                                    . "' style='max-height: 100px; max-width: 100px;'>"
                                    . "<div>"
                                    . "<a href='view.php?id=" . $photo->getId() . "'>View<a/>"
                                    . "</div></td>\n";
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
