<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .custom-container {
      width: 500px;
      height: 500px;

    }
  </style>

</head>

<body>
<div >
    <?php
  require 'partials/_nav.php';
  ?> 

  
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "user";
  $conn = mysqli_connect("$servername", "$username", "$password", "$database");
  if (!$conn) {
    die("fail to connect" . mysqli_connect_error());
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_name = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `myuser1` WHERE username='$username_name'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
          echo '<script>alert("WELCOME USER ")</script>';
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username_name;
          header("Location: welcome.php");
        } else {
          echo '<script>alert("Invalid username or password !")</script>';
        }
      }

    } else {
      echo '<script>alert("Invalid username or password !")</script>';
    }
  }


  ?>
  <div class="container mt-5 ">

    <h3>Login</h3>
    <br>

    <form action="/php/login%20system/login.php" method="post">
      <div class="mb-3">
        <label  for="username" class="form-label">Username</label>
        <input  type="text" class="form-control" name="username" id="username">
        <div id="emailHelp" class="form-text">Enter your username here.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-danger">Submit</button>
    </form>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>