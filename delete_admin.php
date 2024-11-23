<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];

if (isset($id) && is_numeric($id)) {
    $deleteQuery = "DELETE FROM admin WHERE id = $id";
    $deleteResult = mysqli_query($dbc, $deleteQuery);

    if ($deleteResult) {
        header('Location: ../admin_list.php');
        exit();
    } else {
        echo "Failed to delete admin.";
    }
} else {
    echo "Invalid admin ID.";
}
?>
