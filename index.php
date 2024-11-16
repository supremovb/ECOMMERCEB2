<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/app/config/Directories.php");

include(ROOT_DIR."app/product/get_products.php");
require_once("includes/header.php");
?>

    <!-- Navbar -->
    <?php require_once(ROOT_DIR."includes/navbar.php"); ?>

    <!-- Hero Section -->
    <div class="container-fluid bg-primary text-white text-center py-5">
        <h1 class="display-4">Welcome to MyShop!</h1>
        <p class="lead">Your one-stop destination for amazing deals</p>
        <a href="#products" class="btn btn-light btn-lg">Shop Now</a>
    </div>

    <!-- Product Categories -->
    <div class="container content my-5">
        <h2 class="text-center mb-4">Shop by Category</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Category 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Electronics</h5>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Category 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Fashion</h5>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Category 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Home & Kitchen</h5>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="container content my-5" id="products">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row gy-5">
        <?php
                foreach($productList as $product){
                    include(ROOT_DIR.'views/components/product-cart.php');
                }
            ?>
        </div>
    </div>
    
    <!-- Footer -->
    <?php require_once(ROOT_DIR."includes/footer.php"); ?>
