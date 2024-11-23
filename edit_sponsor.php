<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];
$query = "SELECT * FROM sponsor WHERE id = $id";
$result = mysqli_query($dbc, $query);
$sponsor = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_id = $_POST['type_id'];
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE sponsor 
                    SET type_id = '$type_id', amount = '$amount', user_id = '$user_id', status = '$status' 
                    WHERE id = $id";
    $updateResult = mysqli_query($dbc, $updateQuery);

    if ($updateResult) {
        header('Location: sponsor_list.php');
    } else {
        $error = "Failed to update sponsor.";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Edit Sponsor</h2>
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
                            echo "<option value='".$row['id']."' ".($sponsor['type_id'] == $row['id'] ? 'selected' : '').">".ucfirst($row['type'])."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" value="<?php echo $sponsor['amount']; ?>" required />
                </div>
                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" class="form-control" required>
                        <?php
                       
