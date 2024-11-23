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
        <a href="add_payment.php"><button type="button" class="btn btn-primary ml-4 pl-2">Add New Payment</button></a>
    </div>

    <table class="table container">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ticket ID</th>
                <th scope="col">User ID</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM payment";
            $exe = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($exe)) {
                $id = $row['id'];
                $ticket_id = $row['ticket_id'];
                $user_id = $row['user_id'];
                $amount = $row['amount'];
                $date = $row['date'];

                echo "
                <tr>
                    <td>" . $id . "</td>
                    <td>" . $ticket_id . "</td>
                    <td>" . $user_id . "</td>
                    <td>" . $amount . "</td>
                    <td>" . $date . "</td>
                    <td><a href='edit_payment.php?id=$id'><button type='button' class='btn btn-info'>Edit</button></a></td>
                    <td><a href='delete_payment.php?id=$id'><button type='button' class='btn btn-danger'>Delete</button></a></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include_once('./templates/footer.php'); ?>
</body>

</html>
