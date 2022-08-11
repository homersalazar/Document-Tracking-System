<?php
    session_start();
    // Destroy session
    unset($_SESSION['Userlogin']);
    unset($_SESSION['Access']);
    echo header("Location: ../client/login.php");
    
?>