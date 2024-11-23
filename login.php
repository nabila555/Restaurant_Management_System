<?php
session_start();

$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbase = "admin";
$table = "admin";

if(isset($_POST['username']) && isset($_POST['password'])){

$email = $_POST['username'];
$password = $_POST['password'];

$dbc = mysqli_connect("localhost", "root","", $dbase)
	or die("Unable to select database");

$query1 = "SELECT * FROM $table where email='$email' and pass='$password'";
$exe = mysqli_query($dbc, $query1);
$exe1 = mysqli_num_rows($exe);
if ($exe1 > 0) {

	$row = $exe->fetch_assoc();
	$_SESSION['Aname'] = $row["email"];
	$_SESSION['Apass'] = $row["pass"];
	$_SESSION['Aid'] = $row["id"];
	$_SESSION['Aaccess'] = $row["isaccess"];
	if ($row["Access"] == "") {
		$_SESSION['Aaccess'] = "0";
	}
	header('location: home.php');
} else {
	echo "<script>alert(\"Invalid Credentials\")</script>";
}
mysqli_close($dbc);

}

?>