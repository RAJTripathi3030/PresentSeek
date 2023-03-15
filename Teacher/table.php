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

$sql = "SELECT `course`, `branch`, `semester`, `term_start`, `term_end`, `num_lectures`, `section`, `subject` FROM `classes` WHERE `class_name`='$class_name';";
$result2 = mysqli_query($db, $sql);

$row = mysqli_fetch_assoc($result2);

if (isset($_POST['submit'])) {
    $course = $_POST['course'];
    $branch = $_POST['branch'];
    $semester = $_POST['sem'];
    $ts = $_POST['ts'];
    $te = $_POST['te'];
    $num = $_POST['num'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];


    //update data into the database

    $query1 = "UPDATE `$class_name` SET `Sem`='$semester' ;";

    $query2 = "UPDATE `classes` SET `course`='$course',`branch`='$branch',`semester`='$semester',`term_start`='$ts',`term_end`='$te',`num_lectures`='$num',`section`='$section',`subject`='$subject'  WHERE `class_name`='$class_name';";




    mysqli_query($db, $query1);
    mysqli_query($db, $query2);

    header("Refresh:0");
}
mysqli_close($db);



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
                            <a class="nav-link active" href="./ViewClasses.php">
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
                <h4 class="mt-4 text-center">
                    <?php echo "$class_name" ?>
                </h4>
                <br>


                <div class="d-flex justify-content-center">

                    <div class="card w-50 " style="width: 18rem;">
                        <div class="card-header">
                            <strong>Class Details:</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h6>Course :
                                    <?php echo $row['course']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Branch :
                                    <?php echo $row['branch']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Semester :
                                    <?php echo $row['semester']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Term Start Date :
                                    <?php echo $row['term_start']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Term End Date :
                                    <?php echo $row['term_end']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Number of lectures per week :
                                    <?php echo $row['num_lectures']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Section :
                                    <?php echo $row['section']; ?>
                                </h6>

                            </li>
                            <li class="list-group-item">
                                <h6>Subject :
                                    <?php echo $row['subject']; ?>
                                </h6>

                            </li>
                        </ul>
                    </div>



                </div>
                <button type="button" class="btn btn-primary m-auto mt-5 d-flex justify-content-center"
                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Edit Details</button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Make Changes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Course:</label>
                                        <input name="course" type="text" class="form-control" id="course"
                                            value="<?php echo $row['course']; ?>">

                                    </div>

                                    <div class="mb-3">
                                        <h5>Select Branch:</h5>
                                        <h6>Prev Branch:<?php echo $row['branch']; ?></h6>
                                        <select name="branch" id="branchSelect"
                                            aria-label="Default select example">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Semester:</label>
                                        <input name="sem" type="number" class="form-control" id="Semester"
                                            value="<?php echo $row['semester']; ?>">

                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Term Start Date:</label>
                                        <input name="ts" type="date" class="form-control" id="ts"
                                            value="<?php echo $row['term_start']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Term End Date:</label>
                                        <input name='te' type="date" class="form-control" id="te"
                                            value="<?php echo $row['term_end']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">No Of Lectures Per
                                            Week:</label>
                                        <input name="num" type="number" class="form-control" id="NLPW"
                                            value="<?php echo $row['num_lectures']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Section:</label>
                                        <input name='section' type="text" class="form-control" id="section"
                                            value="<?php echo $row['section']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Subject:</label>
                                        <input name="subject" type="text" class="form-control" id="subject"
                                            value="<?php echo $row['subject']; ?>">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button name="submit" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <br>
                <h4 class="mt-4 text-center">Students List
                </h4>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col">Roll No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Sem</th>
                            <th scope="col">Attended</th>
                            <th scope="col">Skipped</th>

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

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="h6 mb-4 mt-4">TOTAL LECTURES:
                    <?= $total ?>
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