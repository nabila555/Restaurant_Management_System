<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$query = "SELECT * FROM `sponsor_type`";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Sponsor Type List</h2>
            <a href="add_sponsor_type.php"><button class="btn btn-primary">Add New Sponsor Type</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo ucfirst($row['type']); ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                                <a href="edit_sponsor_type.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="delete_sponsor_type.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
