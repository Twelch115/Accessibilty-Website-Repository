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

if ( !isset($_POST['stockname'], $_POST['customername'], $_POST['quantity'], $_POST['password'],) ) { //IF all fields weren't filled in
	exit('Please fill in all fields!'); //exit script with this error message
}
$name = $_SESSION['name'];

$stmt = "SELECT Acc_password FROM accounts WHERE Acc_username = '$name'";
$runquery = mysqli_query($con, $stmt);
$fromtable = $runquery->fetch_assoc();
$password = $fromtable['Acc_password'];

if ($_POST['password'] === $password) {
	echo 'Correct password! Adding order... <br>';

	$stockname = $_POST['stockname'];
	$cusname = $_POST["customername"];
    $quant = $_POST['quantity'];

    $stmt = "SELECT Stock_ID FROM stocks WHERE Stock_Name = '$stockname'";
    $runquery = mysqli_query($con, $stmt);
    $fromtable = $runquery->fetch_assoc();
    $stockid = $fromtable['Stock_ID'];

	$stmt = "SELECT Stock_Price FROM stocks WHERE Stock_Name = '$stockname'";
    $runquery = mysqli_query($con, $stmt);
    $fromtable = $runquery->fetch_assoc();
    $stockprice = $fromtable['Stock_Price'];

	$stmt = "SELECT Stock_Amount FROM stocks WHERE Stock_Name = '$stockname'";
    $runquery = mysqli_query($con, $stmt);
    $fromtable = $runquery->fetch_assoc();
    $stockamount = $fromtable['Stock_Amount'];

    $stmt = "SELECT Customer_ID FROM customers WHERE Customer_Name = '$cusname'";
    $runquery = mysqli_query($con, $stmt);
    $fromtable = $runquery->fetch_assoc();
    $cusid = $fromtable['Customer_ID'];

	$pricetotal = $stockprice * $quant;

	if ($quant < $stockamount) {
		$add = "INSERT INTO orders (Order_ID, Customer_ID, Customer_Name, Stock_ID, Stock_Name, Order_Quantity, Order_Total) VALUES ('0', '$cusid','$cusname','$stockid','$stockname','$quant', '$pricetotal')";

		$rs = mysqli_query($con, $add);

		if($rs)
		{
			echo "Order added! \n"; 
			echo ' <a href="../orders.php">Return to orders page.</a>';
		}
	} else {
		echo 'the order you have tried to submit is not possible, as the quantity of items requested excted currently available stocks. <a href="../orders.php">Click here to try again.</a>';
	}
} else {
	echo 'Incorrect password! <a href="../orders.php">Click here to try again.</a>';
}

?>