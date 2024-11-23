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
    <?php
    include_once('./templates/header.php');
    include_once('./templates/sidebar.php');
    ?>
    <br><br>
    <div class="row" style="margin-top: 75px; margin-bottom: 20px; margin-left: 20px;">
        <a href="./components/event/add.php"><button type="button" class="btn btn-primary ml-4 pl-2">Add
                New</button></a>
    </div>
    <table class="table container">
        <thead>
            <tr>
                <th scope="col">Event ID</th>
                <th scope="col">Event Name</th>
                <th scope="col">Description</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query1 = "select * from events";
            $exe1 = mysqli_query($dbc, $query1);
            while ($row1 = mysqli_fetch_array($exe1)) {
                $p_id = $row1['eid'];
                $name = $row1['name'];
                $desc = $row1['description'];
                $type = $row1['type'];
                $date = $row1['date'];
                $time = $row1['time'];
                $img = $row1['image'];
                echo "
                                <tr>
                                    <td>" . $p_id . "</td>
                                    <td>" . $name . "</td>
                                    <td>" . $desc . "</td>
                                    <td>" . $type . "</td>
                                    <td>" . $date . "</td>
                                    <td>" . $time . "</td>
                                    <td>
						<a href='./components/event/update.php?id=$p_id'><button type='button' class='btn btn-info'>Edit</button></a>

            <a href='./components/event/delete.php?id=$p_id'>
                <button type='button' class='btn btn-danger btn-xs'>Delete</button> </a>

            </td>

            </tr>";
            }

            ?>
        </tbody>
    </table>
    </div>
    <div class="col-lg-3"></div>
    </div>
    </div>
    </section>
    <?php
    include_once('./templates/footer.php');
    ?>
    </body>