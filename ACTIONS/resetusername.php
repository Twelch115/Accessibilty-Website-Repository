<?php //begins PHP code

$DATABASE_HOST = 'localhost'; //sets the variable database_host
$DATABASE_USER = 'root'; //sets the variable database_user
$DATABASE_PASS = ''; //sets the variable database_pass
$DATABASE_NAME = '92DK'; //sets the variable database_name

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); //attempts to connect to a dataabase using the above variables data
if ( mysqli_connect_errno() ) { //IF this connection attempt fails
	
	exit('Failed to connect to MySQL: ' . mysqli_connect_error()); //exit script with this error message
}

if ( !isset($_POST['username'], $_POST['email']) ) { //IF username or email were not filled in
	exit('Please fill both the username and email fields!'); //exit script with this error message
}

$Username = $_POST['username']; //get the username from the form
$Email = $_POST['email'] ; //get the email from the form

$sql = "UPDATE accounts SET Acc_username = '$Username' WHERE Acc_email = '$Email'"; //set up the SQL query to update the username at the relevant email location

$rs = mysqli_query($con, $sql); //execute the above query and connect to the database 

if($rs) //IF the rs query succeeds
{
	echo "Username Reset Complete! \n"; //print success message
	echo ' <a href="../index.html">Return to login page.</a>'; //let user return to logi
}
?> <!-- end php code -->