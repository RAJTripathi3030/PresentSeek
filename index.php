<?php
 session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$con = mysqli_connect($host, $user, $password, $db);



if (isset($_POST['username'])) {

  $uname = $_POST['username'];
  $password = $_POST['pass'];
  $_SESSION["user"] = $uname;

  if ($_POST['submit'] === "Login As Student") {
    $sql = "select * from loginformstudent where user='" . $uname . "' AND pass='" . $password . "' limit 1 ; ";
  } else if ($_POST['submit'] === "Login As Teacher") {
    $sql = "select * from loginformteacher where user='" . $uname . "' AND pass='" . $password . "' limit 1 ; ";
  }
  $result = $con->query($sql);

  if (mysqli_num_rows($result) == 1 && $_POST['submit'] === "Login As Teacher") {
    $_SESSION["user"] = $uname;
    $_SESSION["pass"] = $password;
    $_SESSION["loggedIn"] = true;
    header("Location:Teacher/index.php?user=".$uname);
    exit();
  } else if (mysqli_num_rows($result) == 1 and $_POST['submit'] === "Login As Student") {
    $_SESSION["user"] = $uname;
    $_SESSION["pass"] = $password;

    $_SESSION["loggedInS"] = true;
    header("Location:Student/index.php?user=".$uname);    exit();
  } else {
    echo "<script>
    alert('Incorrect Credentials,Login with Correct Credentials,If Lost Kindly Contact Admin');
    setTimeout(function(){
      window.location.href='index.php';
    });
    </script>";
    exit();
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./style.css">
  
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
  <title>PresentSeek</title>
</head>

<body>

<!-- <div class="animate" id="animate">
    
      <svg viewBox="0 0 1320 300">
        <text x="50%" y="50%" dy=".35em" text-anchor="middle">
          PresentSeek
        </text>
      </svg>  
    </div> -->

  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form class="sign-in-form" method="POST">
          <h2 class="title">Student Login Page</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" type="text" required placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="pass" type="password" required placeholder="Password" />
          </div>
          <input name="submit" type="submit" value="Login As Student" class="btn solid" />

        </form>

        <form method="POST" class="sign-up-form">
          <h2 class="title">Faculty Login Page</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" type="text" required placeholder="Username" />
          </div>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="pass" type="password" required placeholder="Password" />
          </div>
          <input name="submit" type="submit" class="btn" value="Login As Teacher" />

        </form>
        <form method="POST" class="admin-form">
          <h2 class="title">Admin Login Page</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" type="text" required placeholder="Username" />
          </div>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="pass" type="password" required placeholder="Password" />
          </div>
          <input name="submit" type="submit" class="btn" value="Login As Teacher" />

        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Not a student ?</h3>
          <p>
            Please Select Accordingly
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Teacher
          </button>
          <button class="btn transparent" id="admin-btn">
              Admin
            </button>

        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Are you a student ?</h3>
          <br />
          <button class="btn transparent" id="sign-in-btn">
            Switch
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const admin_btn = document.querySelector("#admin-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });
    admin_btn.addEventListener('click',()=>{
      container.classlist.add('admin-mode');
    });
  </script>

<script>
    var loader = document.getElementById("animate");
    var dismissLoadingScreen = function () {
      loader.style.opacity = "0";
      setTimeout(() => {
        loader.style.display = 'none';
      }, 800);
    };

    var wait3seconds = function () {
      var result = setTimeout(dismissLoadingScreen, 4000);
    };

    // window.addEventListener("load", wait3seconds);
  </script>
</body>

</html>