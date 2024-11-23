<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$query = "SELECT t.id, e.name as event_name, t.Price, v.name as venue_name
          FROM Ticket t
          JOIN events e ON t.event_id = e.eid
          JOIN venues v ON t.venue_id = v.id";
$result = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('./templates/header.php'); ?>
</head>
<body>
    <div class="sidebar">
        <?php include_once('./templates/sidebar.php'); ?>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
        </nav>
        <div class="container">
            <h2 style="padding-top: 50px; margin-left: 20px">Ticket List</h2>
            <a href="add_ticket.php"><button class="btn btn-primary">Add New Ticket</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Price</th>
                        <th>Venue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><?php echo $row['venue_name']; ?></td>
                            <td>
                                <a href="edit_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="delete_ticket.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
