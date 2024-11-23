<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];

if (isset($id) && is_numeric($id)) {
    $deleteQuery = "DELETE FROM payment WHERE id = $id";
    $deleteResult = mysqli_query($dbc, $deleteQuery);

    if ($deleteResult) {
        header('Location: payment_list.php');
        exit();
    } else {
        echo "Failed to delete payment.";
    }
} else {
    echo "Invalid payment ID.";
}
?>
