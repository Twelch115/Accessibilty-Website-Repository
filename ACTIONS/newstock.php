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

if ( !isset($_POST['newstock'], $_POST['newingredients'], $_POST['newprice'], $_POST['newamount'], $_POST['supplierid'], $_POST['adminpass']) ) { //IF all fields weren't filled in
	exit('Please fill in all fields!'); //exit script with this error message
}
$name = $_SESSION['name'];

$stmt = "SELECT Acc_password FROM accounts WHERE Acc_username = '$name'";
$runquery = mysqli_query($con, $stmt);
$fromtable = $runquery->fetch_assoc();
$adminpass = $fromtable['Acc_password'];

if ($_POST['adminpass'] === $adminpass) {
	echo 'Correct admin password! Adding stock... <br>';

	$nstock = $_POST['newstock'];
	$ning = $_POST["newingredients"];
	$nprice = $_POST["newprice"];
    $namount = $_POST['newamount'];
	$suppid = $_POST['supplierid'];

	$add = "INSERT INTO stocks (Stock_ID, Stock_Name, Stock_Ingredients, Stock_Price, Stock_Amount, Supplier_ID) VALUES ('0', '$nstock', '$ning','$nprice','$namount','$suppid')";

	$rs = mysqli_query($con, $add);

	if($rs)
	{
		echo "Stock added! \n"; 
		echo ' <a href="../stocks.php">Return to stocks page.</a>';
	}
} else {
	echo 'Incorrect admin password! <a href="../stocks.php">Click here to try again.</a>';
}

?>