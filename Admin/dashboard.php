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


$user = $_SESSION["user"];
$pass = $_SESSION["pass"];

$sql = "SELECT `Name`,`email`,`phone`,`experience` FROM `loginformadmin` WHERE `user`='" . $user . "';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST['submitS'])) {
  $uposition = $_POST['uposition'];
  $uexp = $_POST['uexp'];
  $uemail = $_POST['uemail'];
  $uphone = $_POST['uphone'];
  $upass = $_POST['upass'];

  //update data into the database
  $query2 = "UPDATE `loginformadmin` SET `pass`='$upass',`experience`='$uexp',`email`='$uemail',`phone`='$uphone'  WHERE `user`='$user';";
  $file = fopen('query.log', 'w');
  fwrite($file, $query2);
  fclose($file);

  mysqli_query($db, $query2);

  header("location:dashboard.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <link href="../CSS/bootstrap.min.css" rel="stylesheet">
  <link href="../CSS/dashboard.css" rel="stylesheet">
  <link href="../CSS/dash.css" rel="stylesheet">
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
              <a class="nav-link active" href="./dashboard.php">
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
              <a class="nav-link" href="./addBranches.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Add Branches
              </a>
            </li>

          </ul>
          <hr>

        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <section class="bg-light">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 mb-4 mb-sm-5 mt-sm-5">
                <div class="card card-style1 border-0">
                  <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                    <div class="row align-items-center">
                      <div class="col-lg-6 mb-4 mb-lg-0">

                        <img src="../images/admin.png" class="img-fluid" width="70%" alt="">
                      </div>
                      <div class="col-lg-6 px-xl-10">
                        <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                          <h3 class="h2 text-white mb-0">
                            <?php echo $row['Name']; ?>
                          </h3>
                          <span class="text-primary">
                            <?php echo 'Admin'; ?>
                          </span>
                        </div>
                        <ul class="list-unstyled mb-1-9">
                          <li class="mb-2 mb-xl-3 display-28"><span
                              class="display-26 text-secondary me-2 font-weight-600">Position:</span>
                            <?php echo 'admin'; ?>
                          </li>
                          <li class="mb-2 mb-xl-3 display-28"><span
                              class="display-26 text-secondary me-2 font-weight-600">Experience:</span>
                            <?php echo $row['experience']; ?>
                          </li>
                          <li class="mb-2 mb-xl-3 display-28"><span
                              class="display-26 text-secondary me-2 font-weight-600">Email:</span>
                            <?php echo $row['email']; ?>
                          </li>
                          <li class="display-28"><span
                              class="display-26 text-secondary me-2 font-weight-600">Phone:</span>
                            <?php echo $row['phone']; ?>
                          </li>


                        </ul>
                        <ul class="social-icon-style1 list-unstyled mb-0 ps-0">
                          <li><a href="#!"><i class="ti-twitter-alt"></i></a></li>
                          <li><a href="#!"><i class="ti-facebook"></i></a></li>
                          <li><a href="#!"><i class="ti-pinterest"></i></a></li>
                          <li><a href="#!"><i class="ti-instagram"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </section>

        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
          data-bs-whatever="@mdo">Edit Details</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make Changes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST">
                <div class="modal-body">

                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Password:</label>
                    <input name="upass" type="password" class="form-control" id="pass" value="<?php echo $pass; ?>">
                    <span id="show-password" class="fa fa-eye-slash password-eye-icon"></span>
                  </div>


                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Experience:</label>
                    <input name='uexp' type="text" class="form-control" id="Experience"
                      value="<?php echo $row['experience']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Email:</label>
                    <input name="uemail" type="email" class="form-control" id="Email"
                      value="<?php echo $row['email']; ?>">
                  </div>

                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Phone:</label>
                    <input name="uphone" type="number" class="form-control" id="phone"
                      value="<?php echo $row['phone']; ?>">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button name="submitS" type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
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

    document.getElementById("show-password").addEventListener("click", function () {
      let passwordInput = document.getElementById("pass");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
      } else {
        passwordInput.type = "password";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
      }
    });

    document.querySelector('button[name="submitS"]').addEventListener('click', function () {
      alert("Profile updated successfully!");


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