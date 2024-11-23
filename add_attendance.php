<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $time = $_POST['time'];

    $query = "INSERT INTO `attendances` (user_id, time) VALUES ($user_id, '$time')";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        header('Location: attendance_list.php');
    } else {
        $error = "Failed to add attendance.";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Add Attendance</h2>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form method="post" style="margin-left: 20px">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="number" class="form-control" name="user_id" required>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="datetime-local" class="form-control" name="time" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Attendance</button>
            </form>
        </div>
    </section>
</body>
</html>
