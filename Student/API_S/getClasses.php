<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$conn = mysqli_connect($host, $user, $password, $db);
    
    $query = "SELECT class_name FROM classes";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='".$row['class_name']."'>".$row['class_name']."</option>";
    }
?>
