<?php
session_start();
include("connect.php");
if (!isset($_SESSION['Aname'])) {
    header('location: index.php');
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $query = "UPDATE payment SET ticket_id='$ticket_id', user_id='$user_id', amount='$amount', date='$date' WHERE id=$id";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        header('Location: ../payment_list.php');
    } else {
        echo "Failed to update payment.";
    }
}

$query = "SELECT * FROM payment WHERE id=$id";
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
    <h2 style="padding-top: 120px; margin-left: 20px">Edit Payment</h2>
    <form method="POST" style="margin-left: 20px">
        <div class="form-group">
            <label>Ticket ID</label>
            <input type="number" class="form-control" name="ticket_id" value="<?php echo $row['ticket_id']; ?>" required />
        </div>
        <div class="form-group">
            <label>User ID</label>
            <input type="number" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>" required />
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input type="number" class="form-control" name="amount" value="<?php echo $row['amount']; ?>" required />
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" class="form-control" name="date" value="<?php echo $row['date']; ?>" required />
        </div>
        <input type="submit" class="btn btn-primary" value="Update Payment" />
    </form>
    <?php include_once('./templates/footer.php'); ?>
</body>
</html>
