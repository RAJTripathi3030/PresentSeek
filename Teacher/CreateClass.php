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

$sql = "SELECT `class_name` FROM `classes`;";
$result = mysqli_query($db, $sql);
$existingClasses = [];
while ($row = mysqli_fetch_assoc($result)) {
  array_push($existingClasses, $row['class_name']);
}

//check if the form is submitted
if (isset($_POST['submit'])) {
  $user = $_POST['user'];
  $class_name = $_POST['class_name'];
  $course = $_POST['course'];
  $branch = $_POST['branch'];
  $semester = $_POST['semester'];
  $term_start = $_POST['term_start'];
  $term_end = $_POST['term_end'];
  $num_lectures = $_POST['num_lectures'];
  $subject = $_POST['subject'];
  $section = $_POST['section'];



  //insert data into the database
  $query = "INSERT INTO `classes` (`class_name`, `course`, `branch`, `semester`, `term_start`, `term_end`, `num_lectures`, `section`,`subject`,`user`) 
                  VALUES ('$class_name', '$course', '$branch', '$semester', '$term_start', '$term_end', '$num_lectures', '$section','$subject','$user')";

  $query2 = "CREATE TABLE `$class_name` (
    RollNO bigint(255),
    Names varchar(300),
    Sem int,
    Present int,
    Total int
);";


  mysqli_query($db, $query);
  mysqli_query($db, $query2);
  mysqli_close($db);

  header("location:CreateClass.php");
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
              <a class="nav-link" aria-current="page" href="./Index.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./CreateClass.php">
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
              <a class="nav-link" href="./RemoveStudent.php">
                <span data-feather="user-minus" class="align-text-bottom"></span>
                Remove Student
              </a>
            </li>
          </ul>
          <hr>


        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div id="alert-message"></div>
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Create a New Class</h1>
          <p class="p">Note:Don't use special symbols for class name,only _ allowed</p>
        </div>
        <h4 class="mb-3">Enter Class Details</h4>
        <form action="" method="post" name="createClassForm" onsubmit="return validateForm()">
          <div class="row">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="user" type="number" class="form-control" id="floatingPassword"
                  placeholder="Enter Your User Id" required>
                <label for="floatingPassword">Enter Your User Id<span class="star">*</span></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="class_name" type="text" class="form-control" id="floatingInput"
                  placeholder="Enter Class Name" required>
                <label for="floatingInput">Class Name<span class="star">*</span></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="course" type="text" class="form-control" id="floatingPassword" placeholder="Course"
                  required>
                <label for="floatingPassword">Course<span class="star">*</span></label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <h6>Select Branch:<span class="star">*</span></h6>
                <select name="branch" id="branchSelect" aria-label="Default select example" required>
                  <option></option>
                </select>
              </div>
            </div>


          </div>



          <h4 class=" mb-3">Enter Additional Details</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="term_start" type="date" class="form-control" id="floatingPassword" required>
                <label for="floatingPassword">Term Start Date<span class="star">*</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="term_end" type="date" class="form-control" id="floatingPassword" required>
                <label for="floatingPassword">Term End Date<span class="star">*</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="num_lectures" type="number" class="form-control" id="floatingPassword" required>
                <label for="floatingPassword">Number of lectures planned per week<span class="star">*</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="section" type="text" class="form-control" id="floatingPassword" required>
                <label for="floatingPassword">Section<span class="star">*</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <input name="subject" type="text" class="form-control" id="floatingPassword" required>
                <label for="floatingPassword">Subject<span class="star">*</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input name="semester" type="number" class="form-control" id="floatingPassword" placeholder="Year"
                  required>
                <label for="floatingPassword">Current Semester<span class="star">*</span></label>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary my-4 btn-lg" name="submit">Submit</button>
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

  <script>
    function validateForm() {
      var className = document.forms["createClassForm"]["class_name"].value;
      <?php
      echo "var existingClasses = " . json_encode($existingClasses) . ";\n";
      ?>
      if (existingClasses.includes(className)) {
        alert("Class with name '" + className + "' already exists. Please add another class.");
        return false;
      }
      alert("Class Successfully Added");

      return true;
    }
  </script>



</body>

</html>