<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: login-user.php');  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
            <div class="navbar">
                <div class="logo"><a href="#"><i class='bx bxl-xing'></i>PriceSense.</a></div>
                <ul class="menu">
                <li><a href="./redirect_home.php">Home</a></li>
                <li><a href="./signup-user.php">Register</a></li>
                <div class="cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
                </ul>
                <div class="media-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
    </nav>
    <section class="home" id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="login-user.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-now" value="Login Now">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>
   
</body>
</html>