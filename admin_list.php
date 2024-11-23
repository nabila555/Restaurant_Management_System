<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Aname'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./templates/header.php'); ?>
    <?php include_once('./templates/sidebar.php'); ?>
</head>

<body>
    <br><br>
    <div class="row" style="margin-top: 75px; margin-bottom: 20px; margin-left: 20px;">
        <a href="add_admin.php"><button type="button" class="btn btn-primary ml-4 pl-2">Add New Admin</button></a>
    </div>

    <table class="table container">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Access</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM admin";
            $exe = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($exe)) {
                $id = $row['id'];
                $name = $row['name'];
                $email = $row['email'];
                $isaccess = $row['isaccess'];

                echo "
                <tr>
                    <td>" . $id . "</td>
                    <td>" . $name . "</td>
                    <td>" . $email . "</td>
                    <td>" . ($isaccess ? 'Active' : 'Inactive') . "</td>
                    <td><a href='edit_admin.php?id=$id'><button type='button' class='btn btn-info'>Edit</button></a></td>
                    <td><a href='delete_admin.php?id=$id'><button type='button' class='btn btn-danger'>Delete</button></a></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include_once('./templates/footer.php'); ?>
</body>

</html>
