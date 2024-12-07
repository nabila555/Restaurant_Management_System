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
        <a href="./components/participant/add.php"><button type="button" class="btn btn-primary ml-4 pl-2">Add New</button></a>
    </div>
    <table class="table container">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">User ID</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query1 = "SELECT * FROM participants";
            $exe1 = mysqli_query($dbc, $query1);
            while ($row1 = mysqli_fetch_array($exe1)) {
                $p_id = $row1['pid'];
                $name = $row1['eid'];
                $user_id = $row1['uid'];
                echo "
                    <tr>
                        <td>" . $p_id . "</td>
                        <td>" . $name . "</td>
                        <td>" . $user_id . "</td>
                        <td>
                            <a href='./components/participant/edit.php?id=$p_id'><button type='button' class='btn btn-info'>Edit</button></a>
                        </td>
                        <td>
                            <a href='./components/participant/delete.php?id=$p_id'><button type='button' class='btn btn-danger btn-xs'>Delete</button></a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
