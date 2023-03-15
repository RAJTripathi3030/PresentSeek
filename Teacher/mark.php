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

$class_name = $_GET['class_name'];

$query = "SELECT * FROM `$class_name` ORDER BY `RollNO` ;";
$result = mysqli_query($db, $query);


$data = array(
  'result' => $result
);
$new = $result;

if (isset($_POST['submit'])) {

  $double = $_POST['double'];

  if ($double == 1) {
    while ($row = mysqli_fetch_array($new)) {
      $name = $row['Names'];
      $present = $row['Present'];
      $total = $row['Total'];
      $roll_no = $row['RollNO'];
      $status = "A";


      if (isset($_POST['stat'][$roll_no])) {
        $status = "P";
        $present = $present + 2;
      }
      $total = $total + 2;
      $update_query = "UPDATE `$class_name` SET `Present` = '$present', `Total` = '$total' WHERE `RollNO` = '$roll_no'";
      mysqli_query($db, $update_query);
      $query2 = "INSERT INTO `attendance`(`SName`, `class_name`, `date`, `status`, `RollNO`) VALUES ('$name','$class_name',CURRENT_TIMESTAMP,'$status','$roll_no')";
      mysqli_query($db, $query2);
      $query2 = "INSERT INTO `attendance`(`SName`, `class_name`, `date`, `status`, `RollNO`) VALUES ('$name','$class_name',CURRENT_TIMESTAMP,'$status','$roll_no')";
      mysqli_query($db, $query2);
    }


  } else {
    while ($row = mysqli_fetch_array($new)) {
      $name = $row['Names'];
      $present = $row['Present'];
      $total = $row['Total'];
      $roll_no = $row['RollNO'];
      $status = "A";

      if (isset($_POST['stat'][$roll_no])) {
        $status = "P";
        $present++;
      }
      $total++;
      $update_query = "UPDATE `$class_name` SET `Present` = '$present', `Total` = '$total' WHERE `RollNO` = '$roll_no'";

      mysqli_query($db, $update_query);
      $query2 = "INSERT INTO `attendance`(`SName`, `class_name`, `date`, `status`, `RollNO`) VALUES ('$name','$class_name', CURDATE(),'$status','$roll_no')";
      mysqli_query($db, $query2);
    }


  }
  header("location:attendance.php");
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
              <a class="nav-link active" href="./attendance.php">
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
        <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
          <strong>After Succesfull Submission of Attendance,You will be redirected to class selection!</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <h2 class="mb-3 mt-2">Mark Attendance</h2>
        <div class="form-check form-switch mt-4">
          <input class="form-check-input" type="checkbox" id="mark-all-present">
          <label class="form-check-label" for="flexSwitchCheckDefault">
            <h6>MARK ALL PRESENT</h6>
          </label>
        </div>
        <form method="POST">
          <div class="form-check form-switch mt-4 mb-4">
            <input class="form-check-input" type="checkbox" name="double" value="1">
            <label class="form-check-label" for="flexSwitchCheckDefault">
              <h6> MARK ATTENDANCE FOR TWO CLASSES</h6>
            </label>
          </div>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Roll No</th>
                <th scope="col">Name</th>
                <th scope="col">Sem</th>
                <th scope="col">Attended</th>
                <th scope="col">Skipped</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_array($result)):
                $total = $row['Total'];
                ?>
                <tr>
                  <th scope="row">
                    <?= $row['RollNO'] ?>
                  </th>
                  <td>
                    <?= $row['Names'] ?>
                  </td>
                  <td>
                    <?= $row['Sem'] ?>
                  </td>
                  <td>
                    <?= $row['Present'] ?>
                  </td>
                  <td>
                    <?= $row['Total'] - $row['Present'] ?>
                  </td>
                  <td>
                    <div class="form-check form-switch mt-1 mb-1">
                      <input class="form-check-input student-checkbox" type="checkbox"
                        name="stat[<?php echo $row['RollNO']; ?>]" value="1">
                      <label class="form-check-label" for="flexSwitchCheckDefault">
                        PRESENT
                      </label>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
          <div class="h6 mb-4 mt-4">TOTAL LECTURES:
            <?= $total ?>
          </div>
          <input class="btn btn-primary" type="submit" name="submit">
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

    // variable to keep track of the checkbox state
    let checkboxState = false;

    //get the mark all present button
    var markAllPresentButton = document.getElementById('mark-all-present');

    //add an event listener to the button
    markAllPresentButton.addEventListener('click', function () {
      //get all the checkboxes
      var checkboxes = document.querySelectorAll('.student-checkbox');

      // toggle the checkbox state
      checkboxState = !checkboxState;

      //iterate through the checkboxes and check/uncheck them based on the current state
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = checkboxState;
      }

      //get the form
      var form = this.closest('form');
      //submit the form
      form.submit();



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