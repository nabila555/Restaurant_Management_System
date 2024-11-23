<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];
$deleteQuery = "DELETE FROM `query` WHERE id = $id";
$result = mysqli_query($dbc, $deleteQuery);

if ($result) {
    header('Location: query_list.php');
} else {
    echo "Failed to delete query.";
}
?>
