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

//check if the form is submitted
if (isset($_POST['submitD'])) {

  $class = $_POST['class'];
  $date = date('m/d/Y', strtotime($_POST['date']));
  $date = explode('/', $date);
  $month = $date[0];
  $day = $date[1];
  $year = $date[2];

  $sql = "SELECT * FROM `attendance` WHERE class_name=\"cse_ds_b_data_struc\";";

  $sql = "SELECT * FROM `attendance` WHERE YEAR(date)=$year and MONTH(date)=$month and DAY(date)=$day and class_name=\"$class\";";
  $result = mysqli_query($db, $sql);

  //create a new file and name it
  $file = fopen("Attendance_" . $month . "_" . $day . "_" . $year . ".csv", "w");

  //set the column headers
  $headers = array("Name", "Class", "Date", "Status", "RollNO");
  fputcsv($file, $headers);

  //loop through the query results and write them to the file
  while ($row = mysqli_fetch_assoc($result)) {
    //$row['date'] = date('m/d/Y', strtotime($_POST['date']));
    fputcsv($file, $row);
  }

  //close the file
  fclose($file);

  //set the headers to make the file available for download
  header("Content-Type: application/csv");
  header("Content-Disposition: attachment; filename=Attendance_" . $month . "_" . $day . "_" . $year . ".csv");
  header("Pragma: no-cache");
  header("Expires: 0");

  //read the file and output its contents
  readfile("Attendance_" . $month . "_" . $day . "_" . $year . ".csv");
  unlink("Attendance_" . $month . "_" . $day . "_" . $year . ".csv");
  exit;
}
if (isset($_POST['submitF'])) {

  $branch = $_POST['branch'];
  $section = $_POST['section'];

  $sql1 = "SELECT `class_name`,  `subject` FROM `classes` WHERE  `branch`='$branch' and `section`='$section' ;";

  $result1 = mysqli_query($db, $sql1);

  $class_names = array();
  $subjects = array();
  while ($row = mysqli_fetch_assoc($result1)) {
    array_push($class_names, $row['class_name']);
    array_push($subjects, $row['subject']);
  }
  $i = 0;
  $query = "SELECT ";
  $query .= $class_names[0] . ".Names, ";
  $query .= $class_names[0] . ".RollNO, ";
  foreach ($class_names as $class_name) {
    $query .= $class_name . ".Present as " . ($subjects[$i] . "_P,");
    $query .= $class_name . ".Total as " . ($subjects[$i] . "_T,");
    $i++;
  }

  $query = rtrim($query, ", ");
  $query .= " FROM " . implode(", ", $class_names) . " ";

  for ($i = 0; $i < count($class_names); $i++) {
    if ($i == 0) {
      $query .= "where " . $class_names[$i] . ".RollNO=" . $class_names[$i + 1] . ".RollNO ";
    } else if ($i < count($class_names) - 1) {
      $query .= "AND " . $class_names[$i] . ".RollNO=" . $class_names[$i + 1] . ".RollNO ";
    }
  }
  $query .= "ORDER by " . $class_names[0] . ".RollNO;";

  $result = mysqli_query($db, $query);

  $file = fopen('Attendance.csv', 'w');

  $K = array("SNo.","Name", "RollNo","Section");

  for ($h = 0; $h < count($subjects); $h++) {
    array_push($K, $subjects[$h] . " ATT");
    array_push($K, $subjects[$h] . " MAX");

  }

  array_push($K,"Total ATT");
  array_push($K,"Total MAX");
  array_push($K,"Per. Att.");

  $headers = $K;
  fputcsv($file, $headers);



  $c = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $array = array_values($row);
    $ta = 0;
    $gt = 0;
    for ($i = 2; $i < count($array);$i+=2)
    {
      $ta = $ta + $array[$i];
      $gt = $gt + $array[$i + 1];
    }
    if($gt==0)
    {
      $p = 0;
    }
    else{
      $p = ($ta / $gt) * 100;

    }
    array_push($array, $ta);
    array_push($array, $gt);
    array_push($array, $p);
    array_splice($array, 2, 0, $section);
    array_splice($array, 0, 0, $c);
    fputcsv($file, $array);
    $c+=1;
  }

  fclose($file);

  // Code to retrieve $result
  header("Content-Type: application/csv");
  header("Content-Disposition: attachment; filename=Attendance.csv");
  header("Pragma: no-cache");
  header("Expires: 0");

  readfile("Attendance.csv");
  unlink("Attendance.csv");

  exit;

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

              <a class="nav-link active" href="./classreport.php">
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
      <h2 class="h2 mt-4">Download Attendance Reports</h2>
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Date Report
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <form method="POST">
                  <div class="mb-3">
                    <h6>Select Class:</h6>
                    <select name="class" id="classSelect" aria-label="Default select example">
                      <option></option>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Select Date:</span>
                    <input name="date" type="date" class="w-25 p-3" placeholder="Date" aria-label="Date"
                      aria-describedby="basic-addon1">
                    <button name="submitD" class="btn btn-outline-secondary">Download</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Full Report
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <form method="POST">
                  <h6>Select Branch:</h6>
                  <select name="branch" id="branch" aria-label="Default select example">
                    <option></option>
                  </select>
                  <h6>Select Section:</h6>
                  <select name="section" id="section" aria-label="Default select example">
                    <option></option>
                  </select>
                  <button name="submitF" class="btn btn-outline-secondary form-control mt-4">Download</button>
                </form>
              </div>
            </div>
          </div>
        </div>
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

    fetch('./API_S/b.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('branch').innerHTML = data;
      });

    fetch('./API_S/s.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('section').innerHTML = data;
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