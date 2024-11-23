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
    <link rel="shortcut icon"
        href="https://www.google.com/url?sa=i&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FMadras_Institute_of_Technology&psig=AOvVaw24Hw_au4PBbWiMiHhdyvE4&ust=1666952722381000&source=images&cd=vfe&ved=0CA0QjRxqFwoTCKCDkfuYgPsCFQAAAAAdAAAAABAE"
        type="image/x-icon">

    <title>Event Management System | View Feedback</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftJdbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php include_once('./templates/sidebar.php'); ?>

    <div class="container" style="padding-top: 150px; padding-left: 50px">
        <div class="row">
            <div class="col-lg-8">
                <h2>Feedback</h2>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">User ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM feedbacks";
                        $result = mysqli_query($dbc, $query);

                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $description = $row['description'];
                            $user_id = $row['user_id'];

                            echo "
                                <tr>
                                    <td>$id</td>
                                    <td>$name</td>
                                    <td>$description</td>
                                    <td>$user_id</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

    <?php include_once('./templates/footer.php'); ?>
</body>

</html>
