<?php //begins PHP code
session_start(); //initialises a session

if (!isset($_SESSION['loggedin'])) { //IF the session does NOT have the loggedin paramiter from authenticate.php
	header('Location: index.html'); //Redirect to the index page
	exit; //exit code
}

?> <!-- end php code https://stackoverflow.com/questions/14292997/changing-style-sheet-javascript-->

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
		<link id="pagestyle" rel="stylesheet" href="style.css?rnd=123" type="text/css"> <!-- connects the page to a stylesheet for the layout/colouring of the page -->	
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
			<h2 id = "hometitle">Home Page</h2> <!-- creates a H2 text box -->
			<p id = "instructions"> Welcome to the 92 Donner Kings Stock management system! Select the page you want to view from the navigation bar at the top:</p> <!-- welcomes the user to the system and introduces the list -->
				<ul> <!-- an unordered list for explaining each page on the site -->
					<li id = "list1">Home: Where you are right now.</li>   
					<li id = "list2">Stocks: View the stocks currently available and their suppliers. [admins can modify them].</li>   
					<li id = "list3">Customers: View the customers currently in the system.</li> 
					<li id = "list4">Orders: View & add orders to the system.</li>
					<li id = "list5">Profile: View your user profile, and change your username/passoword.</li>
					<li id = "list6">Admin: ADMINS ONLY. View all user and business location data and add/remove instances of both.</li>
					<li id = "list7">Settings: Bring up the settings pannel where you can change the page language.</li>
					<li id = "list8">Logout: Log out of the system.</li>
				</ul> <!-- ends list -->
			
		</div> <!-- closes the div container -->
	</body> <!-- closes the body tag-->
</html> <!-- ends the HTML code -->