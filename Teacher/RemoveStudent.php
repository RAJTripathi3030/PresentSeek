<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
  header("Location: ../index.php");
  exit;
}

//connect to the database
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$db = mysqli_connect($host, $user, $password, $db);

//check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {

  $class = $_POST['class'];
  $roll = $_POST['roll'];

  $sql = "DELETE FROM attendance WHERE RollNo=$roll;";
  $sql2 = "DELETE FROM $class WHERE RollNo=$roll;";
   mysqli_query($db, $sql);
   $result =mysqli_query($db, $sql2);
  
  if (mysqli_affected_rows($db) == 0) {
    echo "<script>
    alert('No student with the given roll number exists');
    window.location.href = 'RemoveStudent.php';
    </script>";
  }
  else{
    echo "<script>
    alert('Student Succesfully Removed');
    window.location.href = 'RemoveStudent.php';
    </script>";
    

  }
  exit();

}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>PresentSeek</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">

  <link href="../CSS/bootstrap.min.css" rel="stylesheet">
  <link href="../CSS/dashboard.css" rel="stylesheet">
  <link href="../CSS/dash.css" rel="stylesheet">
</head>

<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><strong>PresentSeek</strong></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" id="BANTI" type="button"
      data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <ul class="nav justify-content-center form-control form-control-dark w-100 rounded-0 border-0 p-0 bg-dark ">
      <li class="nav-item">
        <a class="nav-link active" href="./index.php">Home</a>

      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="../features.html">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="../about.html">About Us</a>
      </li>
      <li>
        <a class="nav-link btn text-light" id="signout" onclick="signOut()">Sign out</a>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">

          <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Key functionalities</span>
          </h6>

          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="./Index.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./CreateClass.php">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Create Class
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./AddStudent.php">
                <span data-feather="user-plus" class="align-text-bottom"></span>
                Add Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./attendance.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Mark Attendance
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./classreport.php">
                <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                Attendance Reports
              </a>
            </li>
          </ul>
          <hr>
          <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Manage Your Class</span>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="./ViewClasses.php">
                <span data-feather="edit" class="align-text-bottom"></span>
                View & Update Classes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./RemoveClass.php">
                <span data-feather="trash-2" class="align-text-bottom"></span>
                Remove Class
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./RemoveStudent.php">
                <span data-feather="user-minus" class="align-text-bottom"></span>
                Remove Student
              </a>
            </li>
          </ul>
          <hr>


        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-3">


        <h2 class="mb-3">Remove Student</h2>
        <h6 class="mb-4">Select the student's class:
        </h6>

        <form method="POST">

          <p class="mb-4">
            <select name="class" id="classSelect" aria-label="Default select example">
              <option></option>
            </select>
          </p>

          <input name="roll" class="form-control mb-3" type="number" placeholder="Enter Roll Number"
            aria-label="default input example" required>
          <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            style="border: 2px solid black;">
            Remove Student
          </button>
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">

            
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Remove This Student?</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure that you want to remove this
                  student?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </main>
    </div>
  </div>


  <script src="../JS/bootstrap.bundle.min.js"></script>
  <script src="../JS/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
    crossorigin="anonymous"></script>

  <script>

    fetch('./API_S/getClasses.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById("classSelect").innerHTML = data;
      });


    function signOut() {
      fetch('signout.php')
        .then(response => {
          if (response.ok) {
            // redirect to login page
            window.location = '../index.php';
          }
        });
    }

  </script>
</body>

</html>