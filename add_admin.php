<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Aname'])) {
    header('location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $isaccess = isset($_POST['isaccess']) ? 1 : 0; // Access status: 1 (active), 0 (inactive)

    $query = "INSERT INTO admin (name, pass, email, isaccess) VALUES ('$name', '$pass', '$email', '$isaccess')";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        header('Location:admin_list.php');
    } else {
        echo "Failed to add admin.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('./templates/header.php'); ?>
    <?php include_once('./templates/sidebar.php'); ?>
</head>
<body>
    <h2 style="padding-top: 120px; margin-left: 20px">Add New Admin</h2>
    <form method="POST" style="margin-left: 20px">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="pass" required />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required />
        </div>
        <div class="form-group">
            <label>Access: </label>
            <input type="checkbox" name="isaccess" value="1"> Active
        </div>
        <input type="submit" class="btn btn-primary" value="Add Admin" />
    </form>
    <?php include_once('./templates/footer.php'); ?>
</body>
</html>
