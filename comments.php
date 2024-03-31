<?php
require 'partials/_nav.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit;
}
require ('partials/welcome_conn.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMMENTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 800px;
            flex-direction: column;
        }

        #exampleInputEmail1 {
            width: 800px;
            height: 25px
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
    $sno = $_GET['threadid'];
    require ('partials/welcome_conn.php');
    $sql1 = "SELECT *FROM `data10` WHERE sno=$sno";
    $result = mysqli_query($conn, $sql1);
    if (!$result) {
        die('Error: ' . mysqli_error($conn));

    }
    $user_name=$_SESSION['username'];
    $sql2 = "SELECT * FROM `comment_data` WHERE sno = $sno";
    $result2 = mysqli_query($conn, $sql2);
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment = $_POST['comment'];
        //$sql = "INSERT INTO `comment_data` (`sno`, `username`,`comment`,`time`) VALUES ('$sno','$user_name','$comment',current_timestamp())
        // ";
        $sql="INSERT INTO `comment_data` (`sno`, `comment`, `username`,`time`) VALUES ('$sno', '$comment', '$user_name',current_timestamp())";
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
    <div class="container">
        <div class="jumbotron">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<h1 class="display-4">Welcome to  ' . $row['categories'] . '</h1>
                    <hr class="my-4">
                    <p> ' . $row['categories_description'] . '</p>
                     <a class="btn btn-danger btn-lg" href="#" role="button">Learn more</a>
                    '
                ;
            }
            ?>
        </div>


        <br>
        <h4>Comments</h4>
        <br>
        <!-- comments -->
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Comment </label>
                <input type="text" class="form-control" name="comment" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
        <br>

        <?php
          $question_number = 1;
        while ($row1 = mysqli_fetch_assoc($result2)) {
          
            echo '       
           <div class="media">
          <img src="/php/login system/partials/istockphoto-1300845620-612x612.jpg" width="54px"
            class="align-self-center mr-3" alt="..."> <p>' . $row1['username'] . ' </p>
          
          <div class="media-body">          
           <h5>' . $question_number . '.</h5>
            <p>' . $row1['comment'] . ' <br> <br>commented on :' . $row1['time'] . '</p>
        

          </div>
        </div>'
            ;
            $question_number++;
        }
        ?>

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
</body>