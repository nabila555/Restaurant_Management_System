<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$query = "SELECT sponsor.id, sponsor.amount, sponsor.status, sponsor_type.type AS sponsor_type, users.name 
          FROM sponsor
          JOIN sponsor_type ON sponsor.type_id = sponsor_type.id
          JOIN users ON sponsor.user_id = users.uid";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Sponsor List</h2>
            <a href="add_sponsor.php"><button class="btn btn-primary">Add New Sponsor</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sponsor Type</th>
                        <th>Amount</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo ucfirst($row['sponsor_type']); ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                                <a href="edit_sponsor.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="delete_sponsor.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
