<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];
$deleteQuery = "DELETE FROM `Ticket` WHERE id = $id";
$deleteResult = mysqli_query($dbc, $deleteQuery);

if ($deleteResult) {
    header('Location: ticket_list.php'); // Redirect to the ticket list after successful deletion
} else {
    echo "Failed to delete ticket.";
}
?>
