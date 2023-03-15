<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$conn = mysqli_connect($host, $user, $password, $db);
$class = $_GET['class'];
$roll = $_GET['roll'];

$sql = "SELECT 'RollNo' FROM `$class` WHERE `RollNo` = '$roll'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
  echo json_encode(array("exists" => true));
} else {
  echo json_encode(array("exists" => false));
}

mysqli_close($conn);

?>
