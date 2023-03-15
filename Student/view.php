<?php
session_start();
if (!isset($_SESSION["loggedInS"]) || $_SESSION["loggedInS"] !== true) {
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

if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
$userS = $_SESSION["user"];

//check if the form is submitted
if (isset($_POST['submitD'])) {
  $date = date('m/d/Y', strtotime($_POST['date']));
  $date = explode('/', $date);
  $month = $date[0];
  $day = $date[1];
  $year = $date[2];

  $sql = "SELECT `class_name`,`date`,`status` FROM `attendance` WHERE YEAR(date)=$year and MONTH(date)=$month and DAY(date)=$day and `RollNO`=$userS;";
  $result = mysqli_query($db, $sql);

  //create a new file and name it
  $file = fopen("Attendance_" . $month . "_" . $day . "_" . $year . ".csv", "w");

  //set the column headers
  $headers = array("Class", "Date", "Status");
  fputcsv($file, $headers);

  //loop through the query results and write them to the file
  while ($row = mysqli_fetch_assoc($result)) {
    $row['date'] = date('m/d/Y', strtotime($_POST['date']));
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

$x = 0;

$q1 = "SELECT * FROM loginformstudent where `user`=$userS";
$res1 = mysqli_query($db, $q1);
$r1 = mysqli_fetch_assoc($res1);
$branch = $r1['branch'];
$section = $r1['section'];
$sql1 = "SELECT `class_name`,  `subject` FROM `classes`;";
$result1 = mysqli_query($db, $sql1);
$class_names = array();
$subjects = array();
while ($row = mysqli_fetch_assoc($result1)) {
  array_push($class_names, $row['class_name']);
  array_push($subjects, $row['subject']);
}
$i = 0;
$query = "SELECT ";
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
$query .= "AND " . $class_names[0] . ".RollNO=" . "$userS;";
 
$result = mysqli_query($db, $query);
$K = array();
for ($h = 0; $h < count($subjects); $h++) {
  array_push($K, $subjects[$h] . " ATTENDED LECTURES");
  array_push($K, $subjects[$h] . " MAX LECTURES");
}
array_push($K, "Total ATT");
array_push($K, "Total MAX");
array_push($K, "Percentage Att.");
$row = mysqli_fetch_assoc($result);
$array = array_values($row);
$ta = 0;
$gt = 0;
for ($i = 0; $i < count($array); $i += 2) {
  $ta = $ta + $array[$i];
  $gt = $gt + $array[$i + 1];
}
if ($gt == 0) {
  $p = 0;
} else {
  $p = ($ta / $gt) * 100;
  if ($p < 75) {
    $x = 3 * $gt - 4 * $ta;
  }
}
array_push($array, $ta);
array_push($array, $gt);
array_push($array, $p);

function getWeeksBetweenDates($date1, $date2)
{
  $start = new DateTime($date1);
  $end = new DateTime($date2);
  $interval = $start->diff($end);
  return floor($interval->days / 7);
}

$endSum = 0;

foreach ($class_names as $class_name) {
  $newQuery = "SELECT  `term_start`, `term_end`, `num_lectures` FROM `classes` WHERE `class_name`='$class_name'";
  $ot = mysqli_query($db, $newQuery);
  $data = mysqli_fetch_assoc($ot);
  $date1 = $data['term_start'];
  $date2 = $data['term_end'];
  $nl = $data['num_lectures'];

  $weeks = getWeeksBetweenDates($date1, $date2);
  $endSum += $weeks * $nl;
}

$target = (int) (0.75 * $endSum);
$tobedone = $target - $ta;

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="../CSS/dash.css">
  <link rel="stylesheet" href="../CSS/profile.css">
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
              <a class="nav-link active" href="./view.php">
                <span data-feather="user-plus" class="align-text-bottom"></span>
                View Attendance
              </a>
            </li>

          </ul>
        </div>
      </nav>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="h2 mt-4">Download Attendance Reports</h2>


        <strong>
          <p class="mt-4">Download Date Wise Report:</p>
        </strong>
        <form method="POST">
          <div class="input-group mt-1 mb-3">
            <span class="input-group-text" id="basic-addon1">Select Date:</span>
            <input name="date" type="date" class="w-25 p-3" placeholder="Date" aria-label="Date"
              aria-describedby="basic-addon1">
            <button name="submitD" class="btn btn-outline-secondary">Download</button>
          </div>
        </form>

        <h4 class=" text-center mt-4">Full Report</h4>
        <table class="table table-hover">
          <?php
          $counter = 0;
          for ($i = 0; $i < count($array); $i++) {
            echo "<tr>";
            echo "<th scope='col' >" . $K[$i] . "</th>";
            echo "<td scope='row'>" . $array[$i] . "</td>";
            echo "</tr>";
            $counter++;
            if ($counter % 2 == 0) {
              echo "<td scope='row'>" . "" . "</td>";
            }
          }
          ?>
        </table>
        <?php
        if ($x > 0) {
          echo "<div class='alert alert-dark p-0' role='alert'>
          <strong><p class='mt-4'>You need to attend $x more lectures continuously to get your attendance back to 75%</p></strong>
        </div>";

        } else {
          echo "<div class='alert alert-dark p-0' role='alert'>
          <strong><p class='mt-4'>Your attendance is above 75%,Keep it up!</p></strong>
        </div>";

        }

        echo "<div class='alert alert-dark mb-5 p-0' role='alert'>
          <strong><p class='mt-4'>By the end of this term you should attend approximately $tobedone classes in order to achieve 75% attendance at the end</p></strong>
        </div>";

        echo "<div class='alert alert-info alert-dismissible fade show mt-5' role='alert'>
        <strong>Note:All the above data is based on mathematical approximation and depend on the frequency of lectures conducted by teachers and may change depending on the increase or decrease in the Term!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
        ?>




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