<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];
$query = "SELECT * FROM `sponsor_type` WHERE id = $id";
$result = mysqli_query($dbc, $query);
$sponsor_type = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE `sponsor_type` SET type = '$type', description = '$description', status = '$status' WHERE id = $id";
    $updateResult = mysqli_query($dbc, $updateQuery);

    if ($updateResult) {
        header('Location: sponsor_type_list.php');
    } else {
        $error = "Failed to update sponsor type.";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Edit Sponsor Type</h2>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form method="post" style="margin-left: 20px">
                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control" required>
                        <option value="individual" <?php echo ($sponsor_type['type'] == 'individual') ? 'selected' : ''; ?>>Individual</option>
                        <option value="corporate" <?php echo ($sponsor_type['type'] == 'corporate') ? 'selected' : ''; ?>>Corporate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required><?php echo $sponsor_type['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" <?php echo ($sponsor_type['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo ($sponsor_type['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Sponsor Type</button>
            </form>
        </div>
    </section>
</body>
</html>
