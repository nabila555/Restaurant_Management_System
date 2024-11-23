<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];
$query = "DELETE FROM `attendances` WHERE id = $id";
$result = mysqli_query($dbc, $query);

if ($result) {
    header('Location: attendance_list.php');
} else {
    echo "Failed to delete attendance.";
}
?>
