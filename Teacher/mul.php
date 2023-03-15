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

// total Finding

$selected_class = $_GET['class_name'];

$sq = "SELECT  MAX(`Total`) FROM $selected_class;";
$kp = mysqli_query($db, $sq);
$ki = mysqli_fetch_array($kp);

if (!empty($ki[0])) {
    $tot = $ki[0];
} else {
    $tot = 0;
}

//xyz

$query = "SELECT `branch`,`semester` from `classes` where `class_name`='$selected_class';";

$result = mysqli_query($db, $query);

$row = mysqli_fetch_array($result);

$q = "SELECT `RollNo` FROM $selected_class;";
$res = mysqli_query($db, $q);

$roll_numbers = array();
while ($r = mysqli_fetch_assoc($res)) {
    $roll_numbers[] = $r['RollNo'];
}

$b = $row['branch'];
$s = $row['semester'];
$roll_numbers_string = implode("','", $roll_numbers);

$query2 = "SELECT `user`,`Name` from `loginformstudent` where `branch`='$b' and `sem`='$s' and `user` NOT IN ('$roll_numbers_string')  ORDER BY `user`;";
$result2 = mysqli_query($db, $query2);

$data = array(
    'result2' => $result2
);
$new = $result2;

if (isset($_POST['submit'])) {
    while ($row = mysqli_fetch_array($new)) {
        $name = $row['Name'];
        $roll_no = $row['user'];
        if (isset($_POST['stat'][$roll_no])) {
            $insert_query = "INSERT INTO `$selected_class`(`RollNO`, `Names`, `Sem`, `Present`, `Total`) 
            VALUES ('$roll_no','$name','$s',0,0)";
            mysqli_query($db, $insert_query);

            $query10 = "UPDATE `$selected_class` SET `Total`='$tot' WHERE `RollNO`='$roll_no';";
            mysqli_query($db, $query10);

        }
    }
    header("Location: AddStudent.php");
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
                            <a class="nav-link active" href="./AddStudent.php">
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

                <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
                    <strong>After Succesfull Addition of Students,You will be redirected to class
                        selection!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
                    <strong>If you see and empty table then no students available with matching criteria of your class
                        or already added!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <h2 class="mb-3 mt-2">Select Students</h2>
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="markAllAdd">
                    <label class="form-check-label" for="flexSwitchCheckDefault">
                        <h6>ADD ALL</h6>
                    </label>
                </div>

                <form method="POST">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Roll No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Addition</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row2 = mysqli_fetch_array($result2)):

                                ?>
                                <tr>
                                    <th scope="row">
                                        <?= $row2['user'] ?>
                                    </th>
                                    <td>
                                        <?= $row2['Name'] ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch mt-1 mb-1">
                                            <input class="form-check-input student-checkbox" type="checkbox" value="1"
                                                name="stat[<?php echo $row2['user']; ?>]">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                ADD
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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
        var markAllAdd = document.getElementById('markAllAdd');

        //add an event listener to the button
        markAllAdd.addEventListener('click', function () {
            //get all the checkboxes
            var checkboxes = document.querySelectorAll('.student-checkbox');

            // toggle the checkbox state
            checkboxState = !checkboxState;

            //iterate through the checkboxes and check/uncheck them based on the current state
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkboxState;
            }


        });


        fetch("./API_S/getClasses.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("class").innerHTML = data;
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