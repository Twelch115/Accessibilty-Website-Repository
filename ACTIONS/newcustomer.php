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

if ( !isset($_POST['newcustomer'], $_POST['newpostcode'], $_POST['newemail'], $_POST['password']) ) { //IF all fields weren't filled in
	exit('Please fill in all fields!'); //exit script with this error message
}
$name = $_SESSION['name'];

$stmt = "SELECT Acc_password FROM accounts WHERE Acc_username = '$name'";
$runquery = mysqli_query($con, $stmt);
$fromtable = $runquery->fetch_assoc();
$password = $fromtable['Acc_password'];

if ($_POST['password'] === $password) {
	echo 'Correct password! Adding customer... <br>';

	$ncuss = $_POST["newcustomer"];
	$npost = $_POST["newpostcode"];
	$nemail = $_POST["newemail"];

	$add = "INSERT INTO customers (Customer_ID, Customer_Name, Customer_Postcode, Customer_Email) VALUES ('0', '$ncuss', '$npost','$nemail')";

	$rs = mysqli_query($con, $add);

	if($rs)
	{
		echo "User added! \n"; 
		echo ' <a href="../customers.php">Return to customers page.</a>';
	}
} else {
	echo 'Incorrect admin password! <a href="../customers">Click here to try again.</a>';
}

?>