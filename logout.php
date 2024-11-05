<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/app/config/Directories.php");
session_start();
require_once("includes/header.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $_SESSION = [];
        session_destroy();
    }
?>

    <!-- Navbar -->
    <?php require_once(ROOT_DIR."includes/navbar.php"); ?>

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card text-center shadow p-3" style="width: 24rem;">
            <div class="card-body">
                <h5 class="card-title">You have been logged out</h5>
                <p class="card-text">Thank you for visiting. You are now logged out.</p>
                <a href="/login.php" class="btn btn-primary">Go to Login</a>
            </div>
        </div>
    </div>

    
    <?php require_once(ROOT_DIR."includes/footer.php"); ?>