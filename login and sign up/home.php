<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
  $sql = "SELECT * FROM usertable WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if ($run_Sql) {
    $fetch_info = mysqli_fetch_assoc($run_Sql);
    $status = $fetch_info['status'];
    $code = $fetch_info['code'];
    if ($status == "verified") {
      if ($code != 0) {
        header('Location: reset-code.php');
      }
    } else {
      header('Location: user-otp.php');
    }
  }
} else {
  header('Location: login-user.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  <link rel="stylesheet" href="./script.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PriceSense</title>
</head>

<body>

  <nav>
    <div class="navbar">
      <div class="logo"><a href="#"><i class='bx bxl-xing'></i>PriceSense.</a></div>
      <ul class="menu">
        <li><i class='bx bxs-user'></i><?php echo $fetch_info['name'] ?></li>
        <li><a href="logout-user.php">Logout</a></li>

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

    <div class="content">
      <h3>Welcome <?php echo $fetch_info['name'] ?></h3>
      <div class="file_upload">



        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <label for="file-input" class="file-label">
            Click here to upload your receipt:
          </label>
          <input type="file" name="file" id="file-input" accept="image/*" />
          <input type="submit" name="submit" value="Upload">
          <?php
          if (isset($_GET['msg']) && !empty($_GET['msg'])) {
            $message = urldecode($_GET['msg']);
            echo '<p style="color: green;">' . $message . '</p>';
          }
          ?>
        </form>

      </div>
      <div class="container">
        <h3>Product Search</h3>
        <form id="search-form">
          <input type="text" id="search-input" placeholder="Search...">
          <input type="submit" value="Search">
        </form>
        <div id="product-list"></div>
      </div>
      <div id="cart">
        <h4>Cart</h4>
        <table id="cart-table">
          <thead>
            <tr>
              <!--  <th>Product</th>
                  
                  <th>Naivas</th>
                  <th>Carrefour</th>
                  <th>Chandarana</th>
                  <th>Quickmart</th>
                  <th>Onn the Way</th>
                  <th>Jumia</th>
                  <th>Quantity</th>
                  <th>Total</th>
                 Add more store columns as needed 
                  <th>Action</th> -->
            </tr>
          </thead>
          <tbody id="cart-items"></tbody>
        </table>
      </div>

    </div>

  </section>

  <footer>
    <div class="text">
      <span>Created By <a href="#">@grandDuke</a> | &#169; 2023 All Rights Reserved</span>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <script src="./Script.js"></script>
  <script src="./file2.js"></script>
  <script>
    // Function to remove the success message after 5 seconds (5000 milliseconds)
    function removeMessage() {
      var messageElement = document.querySelector('p');
      if (messageElement) {
        messageElement.style.display = 'none';
      }
    }

    // Call the removeMessage function after 5 seconds
    setTimeout(removeMessage, 5000);
  </script>

</body>

</html>