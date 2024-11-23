<?php

session_start();

$dbc = mysqli_connect("localhost", "root", "", "admin")
        or die("Unable to select database");

if (!(isset($_SESSION['Aname']))) {
    echo "Unauthorized Access";
    return;
}

if (isset($_POST) & !empty($_POST)) {
    $name = ($_POST['name']);
    $desc = ($_POST['desc']);
    $type = ($_POST['type']);
    $date = ($_POST['date']);
    $time = ($_POST['time']);
    $img = ($_POST['img']);

    $query = "INSERT INTO `events` (name, description, type, time, date, image) 
		VALUES ('$name', '$desc', '$type', '$time', '$date', '$img')";

    $res = mysqli_query($dbc, $query);
    if ($res) {
        header('location: ../../events.php');
    } else {
        $fmsg = "Failed to Insert data.";
        print_r($res);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

<?php include_once('header.php') ?>
</head>

<body>
<?php include_once('../../templates/sidebar.php') ?>

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <img src="https://t4.ftcdn.net/jpg/00/97/00/09/360_F_97000908_wwH2goIihwrMoeV9QF3BW6HtpsVFaNVM.jpg"
                    alt="profile">
                <span class="admin_name">
                    <?php echo $_SESSION["Aname"] ?>
                </span>
                <i class='bx bx-chevron-down'></i>
            </div>
        </nav>
        <div class="container">

            <?php if (isset($fmsg)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $fmsg; ?>
                </div>
            <?php } ?>

            <h2 style="padding-top: 120px; margin-left: 20px">Add New Event</h2>
            <form method="post" style="margin-left: 20px" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="" required />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="desc" value="" required />
                </div>
                <div class="form-group">
                    <label>Category: </label>
                    <select name="type">
                        <option value="technical">Technical</option>
                        <option value="non-technical">Non-Technical</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" value="" />
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="time" class="form-control" name="time" value="" />
                </div>
                <div class="form-group">
                    <label>Image </label>
                    <input type="url" class="form-control" name="img" value="" />
                </div>
                <input type="submit" class="btn btn-primary" value="Add Event" />
            </form>
        </div>

        <?php include_once('../../templates/footer.php') ?>

</body>

</html>