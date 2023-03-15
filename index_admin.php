<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$con = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['user'])) {

  $uname = $_POST['user'];
  $password = $_POST['pass'];


  $sql = "select * from loginformadmin where user='" . $uname . "' AND pass='" . $password . "' limit 1 ; ";
  $result = $con->query($sql);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION["user"] = $uname;
    $_SESSION["pass"] = $password;
    $_SESSION["loggedInA"] = true;
    header("Location:Admin/dashboard.php");
    exit();
  } else {
    $_SESSION["loggedInA"] = false;

    echo "<script>
    alert('Incorrect Credentials,Login with Correct Credentials');
    setTimeout(function(){
      window.location.href='index_admin.php';
    });
    </script>";
    exit();
  }
}

if (isset($_POST['submitS'])) {

  $key = $_POST['key'];

  $uname = $_POST['username'];
  $password = $_POST['upass'];
  $name = $_POST['uname'];
  $exp = $_POST['uexp'];
  $mail = $_POST['uemail'];
  $phone = $_POST['uphone'];



  $sql = "select `user` from loginformadmin ; ";
  $result = mysqli_query($con, $sql);
  $rows = mysqli_fetch_array($result);

  foreach ($rows as $value) {
    if ($value == $uname) {
      echo "<script>alert('User with same credentials Exist');
      window.location.replace('index_admin.php');
      </script>";
      exit();
    }
    if ($uname == "" or $uname = " ") {
      echo "<script>alert('Invalid Credentials');
      window.location.replace('manageStudents.php');
      </script>";
      exit();
    }
  }

  $query = "SELECT * FROM `pointer`;";
  $value = mysqli_fetch_assoc(mysqli_query($con, $query));

  if ($value['pointers'] == $key) {
    $sql2 = "INSERT INTO `loginformadmin`(`user`, `pass`, `Name`, `email`, `phone`, `experience`) VALUES ('$uname','$password','$name','$mail','$phone','$exp')";
    mysqli_query($con, $sql2);

    echo "<script>alert('User Added Successfully');
    window.location.replace('index_admin.php');
    </script>";
    exit();
  } else {
    echo "<script>alert('Invalid Key');
    window.location.replace('index_admin.php');
    </script>";
    exit();
  }

}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Admin Login</title>
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">

</head>


<body>



  <div class="container mt-5 m-auto d-flex flex-column align-items-center">
    <h4 class="mt-5 mb-4">ADMIN LOGIN</h4>
    <form method="POST">
      <div class="mb-3 mt-3">
        <input type="text" name="user" placeholder="User Id" class="form-control mt-2 " id="exampleInputEmail1"
          aria-describedby="emailHelp">
      </div>
      <div class="mb-3 mt-3">
        <input type="password" name="pass" class="form-control mt-2" id="exampleInputPassword1" placeholder="Password">
      </div>

      <div class="mb-3 mt-3">
        <button name="submit" type="submit" class="btn btn-primary w-100">Sign In</button>
      </div>
    </form>

    <div class="grid mt-3">
      <a class="btn btn-primary g-col-5 p-2" role="button" href="index.php" style="margin-right: 3rem;">Go Back</a>
      <button type="button" class="btn btn-primary p-2 g-col-5" data-bs-toggle="modal" data-bs-target="#exampleModal"
        data-bs-whatever="@mdo">Sign Up</button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Key:</label>
                <input name="key" type="text" class="form-control" id="key">
              </div>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input name="uname" type="text" class="form-control" id="name">
              </div>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">UserName:</label>
                <input name="username" type="text" class="form-control" id="username">
              </div>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Password:</label>
                <input name="upass" type="password" class="form-control" id="pass">
                <span id="show-password" class="fa fa-eye-slash password-eye-icon"></span>
              </div>


              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Experience:</label>
                <input name='uexp' type="text" class="form-control" id="Experience">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email:</label>
                <input name="uemail" type="email" class="form-control" id="Email">
              </div>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Phone:</label>
                <input name="uphone" type="number" class="form-control" id="phone">
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
    <p class="mt-4 text-muted text-center">&copy; 2022</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
</body>

</html>