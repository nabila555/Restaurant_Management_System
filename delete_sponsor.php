<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];

// Check if the ID is set and is numeric
if (isset($id) && is_numeric($id)) {
    // Perform delete query
    $deleteQuery = "DELETE FROM sponsor WHERE id = $id";
    $deleteResult = mysqli_query($dbc, $deleteQuery);

    // Redirect to sponsor list page after deletion
    if ($deleteResult) {
        header('Location: sponsor_list.php');
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Failed to delete sponsor.";
    }
} else {
    echo "Invalid sponsor ID.";
}
?>
