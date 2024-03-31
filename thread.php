<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORUM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    .material-symbols-outlined {
      font-size: 15px;
    }
  </style>
  <style>
    .conatiner {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 900px;
    }

    .box {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #exampleInputEmail1 {
      width: 900px;
      height: 25px
    }

    .list-group-item {
      transition: 0.2s;
    }

    .list-group-item:hover {
      transform: scale(1.03);
    }
    .icon {
      cursor: pointer;
      font-size: 20px;
    }

    .navigation-icons {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  </style>
</head>

<body>
  <?php
  require 'partials/_nav.php';
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit;
  }
  $sno = $_GET['catid'];
  require ('partials/welcome_conn.php');
  $sql1 = "SELECT *FROM `data10` WHERE sno=$sno";
  $result = mysqli_query($conn, $sql1);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  //used to fetch question
  $sql2 = "SELECT * FROM `threads_data` WHERE sno = $sno";
  $result2 = mysqli_query($conn, $sql2);
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == 'POST') {
    $question_description = $_POST['question_description'];
    $question = $_POST['question'];
    $username=$_SERVER['username'];
    $sql = "INSERT INTO `threads_data` (`sno`, `question`, `question_description`,`username`) VALUES (' $sno', '$question', '$question_description','$username')";
    $result1 = mysqli_query($conn, $sql);
    if (!$result1) {
      echo "" . mysqli_error($conn);
    } else {
      $result2 = mysqli_query($conn, $sql2);
    }
  }

  ?>
      <div class="navigation-icons">
        <span class="icon" onclick="goBack()">
          <i class="fas fa-arrow-left"></i>
        </span>
        <span class="icon" onclick="goForward()">
          <i class="fas fa-arrow-right"></i>
        </span>
      </div>
  <div class="box">

    <div class="conatiner">
      <div class="jumbotron">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<h1 class="display-4">Welcome to  ' . $row['categories'] . '</h1> 
      <hr class="my-4">
      <p> ' . $row['categories_description'] . '</p>
      <a class="btn btn-danger btn-lg" href="#" role="button">Learn more</a>
    </div>'
          ;
        }
        ?>

        <br>
        <h4>Browse Question</h4>
        <br>
        <!-- asking question -->
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Problem Title</label>
            <input type="text" class="form-control" name="question" id="exampleInputEmail1"
              aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Problem Description</label>
            <input type="text" class="form-control" name="question_description" id="exampleInputEmail1"
              aria-describedby="emailHelp">
          </div>
          <button type="submit" class="btn btn-danger">Submit</button>
        </form>
        <br>
        <!--Displaying the question of an perticular categorie -->
        <?php
        $question_number = 1;
        while ($row1 = mysqli_fetch_assoc($result2)) {

          echo '       
           <div class="media">
          <img src="/php/login system/partials/istockphoto-1300845620-612x612.jpg" width="54px"
            class="align-self-center mr-3" alt="..."><p>' . $row1['username'] . ' </p>
          
          <div class="media-body">          
          <a class="list-group-item list-group-item-action" href="comments.php?threadid=' . $sno . '&thread1id=' . $row1['question_id'] . '"> <h5>' . $question_number . '.</h5><h5 class="mt-0 ">' . $row1['question'] . '</h5>
            <p>' . $row1['question_description'] . ' </p>
          </a>

          </div>
        </div>'
          ;
          $question_number++;
        }
        ?>

      </div>
    </div>
  </div>
  <script>
    // Function to navigate back
    function goBack() {
      window.history.back();
    }

    // Function to navigate forward
    function goForward() {
      window.history.forward();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
