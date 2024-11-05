<?php 
    session_start();
    require_once($_SERVER["DOCUMENT_ROOT"]."/app/config/Directories.php");
    require_once("includes/header.php");

    if(isset($_SESSION["error"])){
        $messErr = $_SESSION["error"];
        unset($_SESSION["error"]);
    }

    if(isset($_SESSION["success"])){
        $messSucc = $_SESSION["success"];
        unset($_SESSION["success"]);
    }
?>

<!-- Navbar -->
<?php require_once(ROOT_DIR."includes/navbar.php"); ?>

    <!-- Login Form -->
    <div class="container content my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Login to Your Account</h4>
                    </div>
                        <div class="card-body">

                            <?php if(isset($messSucc)){ ?>
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $messSucc; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            <?php } ?>


                            <?php if(isset($messErr)){ ?>
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo $messErr; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            <?php } ?>

                            <form action="app/auth/login.php" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                            <div class="card-footer text-center">
                                <p>Don't have an account? <a href="registration.php" class="text-primary">Register here</a></p>
                                <a href="#" class="text-danger">Forgot password?</a>
                            </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <?php require_once(ROOT_DIR."includes/footer.php"); ?>
