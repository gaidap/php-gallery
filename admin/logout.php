<?php
    require_once("includes/header.php");
    $session = Session::getInstance();
    $session->signOut();
