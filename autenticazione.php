<?php
    require_once 'database_config.php';
    session_start();

    function checkAutenticazione() {
        
        if(isset($_SESSION['username'])) {
            return true;
        } else 
            return false;
    }
?>