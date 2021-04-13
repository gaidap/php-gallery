<?php require_once("includes/header.php"); ?>

<?php
    if(!$_SESSION['is_logged_in']) {
        redirect("login.php");
    }
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php require_once("includes/top_nav.php") ?>
    <?php require_once("includes/side_nav.php") ?>
</nav>

<div id="page-wrapper">
    <?php require_once("includes/admin_content.php") ?>
</div>
<!-- /#page-wrapper -->

<?php require_once("includes/footer.php"); ?>
