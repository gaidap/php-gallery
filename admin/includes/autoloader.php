<?php
    
    // Use autoload to include all files automatically.
    spl_autoload_register ( function ($class) {
        $sources = array("./includes/$class.php", "./includes/persistence/$class.php", "./includes/user/$class.php",  "./includes/util/$class.php" );
        
        foreach ($sources as $source) {
            if (file_exists(realpath($source))) {
                require_once $source;
            }
        }
    });
