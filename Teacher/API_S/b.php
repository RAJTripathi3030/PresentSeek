<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$conn = mysqli_connect($host, $user, $password, $db);


$query = "SELECT DISTINCT branch FROM classes";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['branch'] . "'>" . $row['branch'] . "</option>";
}

?>
