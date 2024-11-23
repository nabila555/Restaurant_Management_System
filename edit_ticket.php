<?php
session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin") or die("Unable to connect to database");

if (!isset($_SESSION['Aname'])) {
    echo "Unauthorized Access";
    return;
}

$id = $_GET['id'];
$query = "SELECT * FROM `Ticket` WHERE id = $id";
$result = mysqli_query($dbc, $query);
$ticket = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $price = $_POST['Price'];
    $venue_id = $_POST['venue_id'];

    $updateQuery = "UPDATE `Ticket` SET event_id = '$event_id', Price = '$price', venue_id = '$venue_id' WHERE id = $id";
    $updateResult = mysqli_query($dbc, $updateQuery);

    if ($updateResult) {
        header('Location: ticket_list.php');
    } else {
        $error = "Failed to update ticket.";
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
            <h2 style="padding-top: 50px; margin-left: 20px">Edit Ticket</h2>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form method="post" style="margin-left: 20px">
                <div class="form-group">
                    <label>Event</label>
                    <select name="event_id" class="form-control" required>
                        <?php
                        $events = mysqli_query($dbc, "SELECT * FROM events");
                        while ($event = mysqli_fetch_assoc($events)) {
                            echo "<option value='".$event['eid']."' ".($ticket['event_id'] == $event['eid'] ? 'selected' : '').">".$event['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="Price" value="<?php echo $ticket['Price']; ?>" required />
                </div>
                <div class="form-group">
                    <label>Venue</label>
                    <select name="venue_id" class="form-control" required>
                        <?php
                        $venues = mysqli_query($dbc, "SELECT * FROM venues");
                        while ($venue = mysqli_fetch_assoc($venues)) {
                            echo "<option value='".$venue['id']."' ".($ticket['venue_id'] == $venue['id'] ? 'selected' : '').">".$venue['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Ticket</button>
            </form>
        </div>
    </section>
</body>
</html>
