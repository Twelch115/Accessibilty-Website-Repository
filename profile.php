<?php //begins PHP code
session_start(); //initialises a session

if (!isset($_SESSION['loggedin'])) { //IF the session does NOT have the loggedin paramiter from authenticate.php
	header('Location: index.html'); //Redirect to the index page
	exit; //exit code
}

$DATABASE_HOST = 'localhost'; //sets the variable database_host
$DATABASE_USER = 'root'; //sets the variable database_user
$DATABASE_PASS = ''; //sets the variable database_pass
$DATABASE_NAME = '92DK'; //sets the variable database_name

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); //attempts to connect to a dataabase using the above variables data
if ( mysqli_connect_errno() ) { //IF this connection attempt fails
	
	exit('Failed to connect to MySQL: ' . mysqli_connect_error()); //exit script with this error message
}

$stmt = $con->prepare('SELECT Acc_password, Acc_email FROM accounts WHERE Acc_id = ?'); //createe an SQL satement get the password and email from the database

$stmt->bind_param('i', $_SESSION['id']); //bind the session ID to the statement
$stmt->execute(); //executes the statement
$stmt->bind_result($password, $email); //binds these variables to the statement
$stmt->fetch(); //fetches the results in the above variables
$stmt->close(); //ends the statement

if ($_SESSION['isadmin'] == 1){	//IF session variable isadmin is 1
	$areyouadmin = 'You are an admin.'; //set areyouadmin to yes

} else{
	$areyouadmin = 'You are not an admin.'; //set are you admin to no 
}
?> <!-- end php code -->

<!DOCTYPE html> <!-- tells the browser what version of HTML this page is running-->
<html> <!-- begins HTML code-->
	<head> <!-- opens header section, for setting infomation about the page-->
		<meta charset="utf-8"> <!-- sets the character set used in the page-->
		<title> 92DK Stock Management</title> <!-- sets the page title-->
        <link rel = "icon" href = "IMAGES/icon.jpg"> <!-- sets the favicon-->
		<script src = "SCRIPTS/StyleSwitch.js"></script> <!-- links to the change stylesheet script -->
		<script src = "SCRIPTS/LanguageSelect.js"></script> <!-- links to language selection script for this page --> 
		<script src = "SCRIPTS/SettingsButton.js"></script> <!-- links to settings button script -->
		<script src="https://kit.fontawesome.com/8957024a07.js" crossorigin="anonymous"></script> <!-- connects the page to a script for the font awesome icons -->
		<link id = "pagestyle" href="style.css?rnd=132" rel="stylesheet" type="text/css"> <!-- connects the page to a stylesheet for the layout/colouring of the page-->
	</head> <!-- closes the header-->
    <body class="loggedin"> <!-- opens the body section, with the class loggedin -->
		<nav class="navtop"> <!-- creates a navigation element -->
			<div> <!-- opens a div container -->
				<h1 id = "title"><span style="font-size: 24px; color: darkred;" >92 </span> DK Stock Management</h1> <!-- creates a H1 text box for the nav bar title-->
				<i class="fas fa-house"></i><a id = 'homenav' href="home.php"><b>Home</b></a> <!-- creates a link to the home .php file -->
				<i class="fas fa-cubes"></i><a id = 'stocknav' href="stocks.php">Stocks</a> <!-- creates a link to the stocks .php file -->
				<i class="fas fa-address-book"></i><a id = 'customernav' href="customers.php">Customers</a> <!-- creates a link to the customers .php file -->
				<i class="fas fa-file-invoice"></i><a id = 'ordernav' href="orders.php">Orders</a> <!-- creates a link to the orders .php file -->
				<i class="fas fa-id-card"></i><a id = 'profilenav' href="profile.php">Profile</a> <!-- creates a link to the profile .php file -->
				<i class="fas fa-user-tie"></i><a id = 'adminnav' href="admin.php">Admin</a> <!-- creates a link to the admin .php file -->
				<i class="fas fa-gears"></i><button id = "settingnav" onclick="hideshow()">Settings</button> <!-- creates a button for the settings bar -->
				<i class="fas fa-door-open"></i><a id = 'logoutnav' href="logout.php">Logout</a> <!-- creates a link to the logout .php file -->
			</div> <!-- closes the div container -->
		</nav> <!-- closes the nav container -->
		<div id = "settings" style = "position: absolute; right: 300px; top: 68px; border: solid; padding: 5px; background: #c7b7b7; display: none;"> <!-- creates the settings pop up -->
			<label id="languageLabel" for="languageSelection">Select Language</label> <!-- creates a label for the select language section -->
        	<select id="languageSelection" name="languageSelection" aria-label="Select Language"> <!-- creates the selection drop down for languages --> 
            	<option value="en">🇬🇧 English</option> <!-- sets option for English -->
				<option value="fr">🇫🇷 Français</option> <!-- sets option for French -->
            	<option value="pl">🇵🇱 Polski</option> <!-- sets option for Polish -->
        	</select> <br> <br> <!-- ends selection window creates new lines -->
        	<button id="changeLanguage" onclick="changeLanguage()">Change Language</button> <br> <br> <!-- creates the change language button that refers to the javascript function -->
			<button id="stylesheet1" > Regular Mode </button> <br> <!-- creates a button to swtich to the main stypesheet-->
    		<button id="stylesheet2" > High Contrast Mode </button> <br> <!-- creates a button to switch to the contrasting stylesheet -->
		</div> <!-- ends div for settings popup -->
		<div class="content"> <!-- creates a div with the class content -->
			<h2>Profile </h2> <!-- creates a H2 text box -->
            <div> <!-- opens a div container -->
				<p>Your account details are below:</p> <!-- creates a p box -->
				<table> <!-- initialises a table container -->
					<tr> <!-- creates a table row -->
						<td>Username:</td> <!-- creates a data cell for the username -->
						<td><?=$_SESSION['name']?></td> <!-- adds the users name to the table from the session -->
						<td><a href="loginhelp.html">(Change)</a></td> <!-- links the user back to the change username/password screen -->
					</tr> <!-- ends a row -->
					<tr> <!-- creates a table row -->
						<td>Password:</td> <!-- creates a data cell for the password -->
						<td><?=$password?></td> <!-- adds the users password to the table from the database -->
						<td><a href="loginhelp.html">(Change)</a></td> <!-- links the user back to the change username/password screen -->
					</tr> <!-- ends a row -->
					<tr> <!-- creates a table row -->
						<td>Email:</td> <!-- creates a data cell for the email -->
						<td><?=$email?></td> <!-- adds the users email to the table from the database-->
						<td> </td>
					</tr> <!-- ends a row -->
					<tr> <!-- creates a table row -->
						<td>Admin status:</td>
						<td><?=$areyouadmin?></td>
						<td></td>
					</tr> <!-- ends a row -->
				</table> <!-- closes table -->
			</div> <!-- closes the div container-->
		</div> <!-- closes the class div container-->
	</body> <!-- closes the body tag -->
</html> <!-- ends html code -->