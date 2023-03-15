<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$conn = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['class']) && !empty($_POST['class'])) {

  $class = $_POST['class'];
  $name = $_POST['name'];
  $roll = $_POST['roll'];
  $sem = $_POST['sem'];

  $sq = "SELECT  MAX(`Total`) FROM $class;";
  $kp = mysqli_query($conn, $sq);
  $ki = mysqli_fetch_array($kp);

  if (!empty($ki[0])) {
    $tot = $ki[0];
  } else {
    $tot = 0;
  }

  

  $query = "INSERT INTO `$class` (`RollNo`,`Names`,`Sem`,`Present`,`Total`) VALUES ( '$roll','$name','$sem',0,0)";

  mysqli_query($conn, $query);

  $query2 = "UPDATE `$class` SET `Total`='$tot' WHERE `RollNO`='$roll';";
  mysqli_query($conn, $query2);

  mysqli_close($conn);
}
?>