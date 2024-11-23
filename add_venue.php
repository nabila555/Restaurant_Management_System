<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $status = $_POST['status'];

    $query = "INSERT INTO `venues` (name, location, status) VALUES ('$name', '$location', '$status')";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        header('Location: venue_list.php');
    } else {
        $error = "Failed to add venue.";
    }
}
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
            <h2 style="padding-top: 50px; margin-left: 20px">Add Venue</h2>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form method="post" style="margin-left: 20px">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Venue</button>
            </form>
        </div>
    </section>
</body>
</html>
