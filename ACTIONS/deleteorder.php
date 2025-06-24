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

if ( !isset($_POST['orderid'], $_POST['password']) ) { //IF all fields weren't filled in
	exit('Please fill in all fields!'); //exit script with this error message
}
$name = $_SESSION['name'];

$stmt = "SELECT Acc_password FROM accounts WHERE Acc_username = '$name'";
$runquery = mysqli_query($con, $stmt);
$fromtable = $runquery->fetch_assoc();
$password = $fromtable['Acc_password'];

if ($_POST['password'] === $password) {
	echo 'Correct password! Deleting order... <br>';

	$orderid = $_POST["orderid"];

	$del = "DELETE FROM orders WHERE Order_ID = '$orderid'";

	$rs = mysqli_query($con, $del);

	if($rs)
	{
		echo "Order deleted! \n"; 
		echo ' <a href="../orders.php">Return to customer page.</a>';
	}
} else {
	echo 'Incorrect password! <a href="../orders.php">Click here to try again.</a>';
}

?>