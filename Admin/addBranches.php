<?php
session_start();
if (!isset($_SESSION["loggedInA"]) || $_SESSION["loggedInA"] !== true) {
  header("Location: ../index_admin.php");
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



//check if the form is submitted
if (isset($_POST['submit'])) {

  $branch = $_POST['branch'];

  $sql = "INSERT INTO `branch`(`branch`) VALUES ('$branch')";

  echo "<script>
  alert('Branch Added Successfully');
  </script>";

  mysqli_query($db, $sql);
  mysqli_close($db);
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
              <a class="nav-link" href="./dashboard.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./manageStudents.php">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Manage Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./manageTeachers.php">
                <span data-feather="user-plus" class="align-text-bottom"></span>
                Manage Teachers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./addBranches.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Add Branches
              </a>
            </li>

          </ul>
          <hr>

        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle mt-4" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
            Existing Branches
          </button>
          <ul id="branchSelect" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item   " href="#"></a></li>
          </ul>
        </div>

        <strong><p class="mt-4">Enter Branch to be Added:</p></strong>


        <form method="POST">
          <div class="input-group mb-3">
            <input name="branch" type="text" class="form-control" placeholder="Type Here" aria-label="Branch"
              aria-describedby="basic-addon2">
          </div>
          <button class="btn btn-primary" name="submit">Add</button>
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

    fetch('./API_S/branches.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById("branchSelect").innerHTML = data;
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