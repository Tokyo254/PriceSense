<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                    <form action="login-user.php" method="POST" autocomplete="">
                        <h2 class="text-center">Login</h2>
                        <p class="text-center">Login with your email and password.</p>
                        <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                foreach($errors as $showerror){
                                    echo $showerror;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                        <div class="form-group">
                            <input class="form-control button" type="submit" name="login" value="Login">
                        </div>
                        <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Signup now</a></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

   

    <script src="./file.js"></script>

</body>
</html>