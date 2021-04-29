<?php
    require_once("db_config.php");
    require_once("autoloader.php");
    require_once("redirect.php");
    require_once("message.php");
    require_once("persistence/Database.php");
    require_once("persistence/DatabaseConnection.php");
    require_once("persistence/BaseFactory.php");
    require_once("persistence/BaseRepository.php");
    require_once("persistence/BaseEntity.php");
    require_once("user/User.php");
    require_once("user/UserRepository.php");
    require_once("user/UserFactory.php");
    require_once("session/Session.php");
    $session = Session::getInstance();
