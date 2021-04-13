<?php
    function setMessage($msg) {
        $_SESSION['message'] = $msg;
    }
    
    function showMessage() {
        if (!isset($_SESSION['message'])) {
            return "";
        }
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        return $msg;
    }
