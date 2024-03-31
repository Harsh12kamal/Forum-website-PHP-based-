<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>sign up</title>
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
    $email = $_POST["email"];
    $username_name= $_POST["username"];
    $password = $_POST["password"];
    $confpassword = $_POST["confpass"];
    if ($password != $confpassword) {
      echo '<script>alert("password donot match ")</script>';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `myuser`(`username`,`email`, `password`) VALUES ('$username_name','$email','$hash')";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        echo '<script>alert("Invalid username or password !")</script>';
      } 
      else {
        echo '<script>alert("Thank you for registration")</script>';
        header("Location: login.php");
        exit;
      }
    }
  }

  ?>
  <div class="container mx-auto mt-5 custom-container">

    <h3>Sign up </h3>
    <br>
    <form action="/php/login%20system/signup.php" method="post">
      <div class="mb-3">
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username">
        </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
        <input type="password" name="confpass" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-danger">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>