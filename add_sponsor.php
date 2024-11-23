<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_id = $_POST['type_id'];
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $query = "INSERT INTO `sponsor` (type_id, amount, user_id, status) 
              VALUES ('$type_id', '$amount', '$user_id', '$status')";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        header('Location: sponsor_list.php');
    } else {
        $error = "Failed to add sponsor.";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Add Sponsor</h2>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form method="post" style="margin-left: 20px">
                <div class="form-group">
                    <label>Sponsor Type</label>
                    <select name="type_id" class="form-control" required>
                        <?php
                        $query = "SELECT * FROM sponsor_type WHERE status = 'active'";
                        $result = mysqli_query($dbc, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['id']."'>".ucfirst($row['type'])."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" required />
                </div>
                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" class="form-control" required>
                        <?php
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($dbc, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['uid']."'>".$row['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Sponsor</button>
            </form>
        </div>
    </section>
</body>
</html>
