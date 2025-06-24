<?php
session_start(); //initialises a session

$DATABASE_HOST = 'localhost'; //sets the variable database_host
$DATABASE_USER = 'root'; //sets the variable database_user
$DATABASE_PASS = ''; //sets the variable database_pass
$DATABASE_NAME = '92DK'; //sets the variable database_name

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); //attempts to connect to a dataabase using the above variables data
if ( mysqli_connect_errno() ) { //IF this connection attempt fails
	
	exit('Failed to connect to MySQL: ' . mysqli_connect_error()); //exit script with this error message
}

if ( !isset($_POST['newusername'], $_POST['newpassword'], $_POST['newemail'], $_POST['adminpass'], $_POST['isadmin'], $_POST['newlocid']) ) { //IF all fields weren't filled in
	exit('Please fill in all fields!'); //exit script with this error message
}
$name = $_SESSION['name'];

$stmt = "SELECT Acc_password FROM accounts WHERE Acc_username = '$name'";
$runquery = mysqli_query($con, $stmt);
$fromtable = $runquery->fetch_assoc();
$adminpass = $fromtable['Acc_password'];

if ($_POST['adminpass'] === $adminpass) {
	echo 'Correct admin password! Adding user... <br>';

	$nuser = $_POST["newusername"];
	$npass = $_POST["newpassword"];
	$nemail = $_POST["newemail"];
	$adminstat = $_POST["isadmin"];
	$locid = $_POST['newlocid'];
	//$doemail = $_POST['doemail'];

	$add = "INSERT INTO accounts (Acc_id, Acc_username, Acc_password, Acc_email, Acc_level, Location_ID) VALUES ('0', '$nuser', '$npass','$nemail', '$adminstat', '$locid')";

	$rs = mysqli_query($con, $add);

	if($rs)
	{
		echo "User added! \n"; 
		echo ' <a href="../admin.php">Return to admin hub.</a>';
	}

} else {
	echo 'Incorrect admin password! <a href="../admin.php">Click here to try again.</a>';
}

?>

