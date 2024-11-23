<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Aname'])) {
    header('location: index.php');
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $isaccess = isset($_POST['isaccess']) ? 1 : 0; // Access status: 1 (active), 0 (inactive)

    $query = "UPDATE admin SET name='$name', pass='$pass', email='$email', isaccess='$isaccess' WHERE id=$id";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        header('Location: ../admin_list.php');
    } else {
        echo "Failed to update admin.";
    }
}

$query = "SELECT * FROM admin WHERE id=$id";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('./templates/header.php'); ?>
    <?php include_once('./templates/sidebar.php'); ?>
</head>
<body>
    <h2 style="padding-top: 120px; margin-left: 20px">Edit Admin</h2>
    <form method="POST" style="margin-left: 20px">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="pass" value="<?php echo $row['pass']; ?>" required />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required />
        </div>
        <div class="form-group">
            <label>Access: </label>
            <input type="checkbox" name="isaccess" value="1" <?php echo ($row['isaccess'] == 1) ? 'checked' : ''; ?>> Active
        </div>
        <input type="submit" class="btn btn-primary" value="Update Admin" />
    </form>
    <?php include_once('./templates/footer.php'); ?>
</body>
</html>
