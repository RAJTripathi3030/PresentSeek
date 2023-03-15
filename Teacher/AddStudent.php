<?php
session_start();
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
  header("Location: ../index.php");
  exit;
}

$user = $_SESSION["user"];

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

if (isset($_POST['Tsubmit'])) {
  $selected_class = $_POST['Tclass'];

  header("location:mul.php?class_name=" . $selected_class);




}

//  $file = fopen('query.log', 'w');
//  fwrite($file, $selected_class);
//  fclose($file);

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
        <div id="alert-message"></div>
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2 class="h2">Add New Students</h2>
        </div>

        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <strong>Add Students one by one manually</strong>
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <h4 class="mb-3">Enter Details</h4>
                <h6 class="mb-3">Choose Class</h6>
                <form id="formId" action="" method="post">
                  <div class="row">
                    <div class="mb-4">
                      <select name="class" class="classSelect" aria-label="Default select example">
                        <option></option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Enter Name"
                          required>
                        <label for="floatingInput">Name<span class="star">*</span></label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input name="roll" type="text" class="form-control" id="floatingPassword" placeholder="Course"
                          required>
                        <label for="floatingPassword">Roll No<span class="star">*</span></label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input name="sem" type="text" class="form-control" id="floatingPassword" placeholder="Semester"
                          required>
                        <label for="floatingPassword">Semester<span class="star">*</span></label>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary my-4 btn-lg" name="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <strong>Add Multiple Students</strong> 
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">

                <h4 class="mb-4 ">Select the class in which you want to add students:</h2>
                  <form method="post">
                    <div class="mb-1">
                      <select name="Tclass" class="classSelect2" aria-label="Default select example">
                        <option></option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary my-4 btn-lg" name="Tsubmit">Select</button>
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
        document.querySelector(".classSelect").innerHTML = data;
        document.querySelector(".classSelect2").innerHTML = data;
      });



    document.querySelector("form").addEventListener("submit", async (event) => {
      event.preventDefault();
      const className = document.querySelector(".classSelect").value;
      const name = document.querySelector("input[name='name']").value;
      const roll = document.querySelector("input[name='roll']").value;
      const sem = document.querySelector("input[name='sem']").value;

      const res = await fetch(`./API_S/check_roll.php?class=${className}&roll=${roll}`);
      const data = await res.json();
      if (data.exists) {
        var alertMessage = document.getElementById("alert-message");
        alertMessage.innerHTML = "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Student with same Roll Number Exists!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; return;
      }

      const formData = new FormData();
      formData.append("class", className);
      formData.append("name", name);
      formData.append("roll", roll);
      formData.append("sem", sem);

      const addStudentRes = await fetch("./API_S/add_student.php", {
        method: "POST",
        body: formData,
      });

      if (addStudentRes.ok) {

        var alertMessage = document.getElementById("alert-message");
        alertMessage.innerHTML = "<div class='alert alert-info alert-dismissible fade show' role='alert'><strong>Student added successfully!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

      } else {
        alert("An error occurred while adding the student.");
      }
      document.getElementById("formId").reset();
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