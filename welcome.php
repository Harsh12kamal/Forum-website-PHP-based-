<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("Location: login.php");
  exit;
}

?>
<?php
require ('partials/welcome_conn.php');
$sql1 = "SELECT *FROM `data10`";
$output = mysqli_query($conn, $sql1);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>welcome -
    <?php $_SESSION['username'] ?>
  </title>



  <style>
    .box {
      display: flex;
      height: 350px;
      align-items: center;
      justify-content: center;
      background-image: url("/php/login system/partials/background1.jpg");
      background-size: cover;
      background-position: center;
      background-color: black;
      border-radius: 30px;
    }

    .item {
      font-size: 40px;
      font-family: Lucida;
      color: white;
      text-shadow: 2px 2px 4px #000000;
    }
    .box3 {
      padding-top: 10px;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-around;
      gap: 5px;


    }

    .card {
      transition: 0.2s;
    }

    .card:hover {
      transform: scale(1.1);
    }

    .cont {
      background-size: contain;
      background-position: center;
    }
    @media (max-width: 800px) {
  .box3 {
    flex-direction: column; /* or row, whichever you need */
  }
  }
  .display{
    background-image: url("/php/login system/partials/—Pngtree—computer technology background_757430.jpg");
    background-size: cover;
    background-position: center;
    background-color: black;
     min-height: 100vh;
   
    
  }


   

  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php
  require 'partials/_nav.php';
  ?>
<div class="container-fluid display">
  <div class="cont">
    <br>
    <div class="box">
      <div class="item">
        Welcome 
        <?php $username_name = $_SESSION['username'];
        echo $username_name; ?>
      </div>
    </div>
  </div>

  <div class="box3">
    <?php
    while ($row = mysqli_fetch_assoc($output)) {
      echo '
  
    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
      <div class="card-header">' . $row['categories'] . '</div>
      <div class="card-body">
        <h5 class="card-title">' . $row['categories'] . '</h5>
        <p class="card-text">' . $row['categories_description'] . '</p>
        <a href="http://localhost/php/login%20system/thread.php?catid=' . $row['sno'] . '" class="btn btn-danger">Go TO THREAD</a>
    
    </div>
  </div>';
    }
    ?>

  </div>
</div>
  <script>
   /* 
  window.addEventListener("beforeunload", function(event) {
      // Send an AJAX request to notify the server THIS AJAX REQUEST CHECK WHETHER THE TAB IS CLOSED OR NOT 
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "logout.php", true);
      xhr.send();
  });*/
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>