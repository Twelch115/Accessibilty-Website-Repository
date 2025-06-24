<?php //begins PHP code
session_start(); //initialises a session

if (!isset($_SESSION['loggedin'])) { //IF the session does NOT have the loggedin paramiter from authenticate.php
	header('Location: index.html'); //Redirect to the index page
	exit; //exit code
}

$host    = "localhost"; //host of database
$user    = "root"; //database user
$pass    = ""; //database password
$db_name = "92DK"; //databasename
$connection = mysqli_connect($host, $user, $pass, $db_name); //connect to a database with the above credentials
$result = mysqli_query($connection, "SELECT * FROM orders"); //connect to database and get results 

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
		<link id="pagestyle" href="style.css?rnd=312" rel="stylesheet" type="text/css"> <!-- connects the page to a stylesheet for the layout/colouring of the page-->
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
			<h2>Orders</h2> <!-- creates a H2 text box -->
        	<?php //starts php code block
					echo '<table class="data-table">
        			<tr class="data-heading">';  //initialize a table for the database data and initialize table row tag for the title row
					while ($property = mysqli_fetch_field($result)) { //while there is data in the results variable
    					echo '<td>' . htmlspecialchars($property->name) . '</td>';  //use a row name as a table data
					}
					echo '</tr>'; //end table row tag for the title row

					while ($row = mysqli_fetch_row($result)) { //while there is data in the results variable
    					echo "<tr>"; //start a row 
    					foreach ($row as $item) { //for each item as a row
        					echo '<td>' . htmlspecialchars($item) . '</td>'; //create a table entry for each item
    					}
    				echo '</tr>'; //closes table row tag for one item set
					}
					echo "</table>"; //closes table
			?> <!-- ends php code block -->

			<form action="ACTIONS/neworder.php" method="post" class="orderform"> <!-- creates a form that posts its data to the newuser.php file on submission -->
				<h1> Add new order </h1> <!-- h1 for text -->
				<label for="stockname"> <!-- sets a label for the add stock input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-box"></i> <!-- adds an icon for the stock-->
				</label> <!-- closes label section-->
				<input type="text" name="stockname" placeholder="Name of stock in order" id="stockname" required size="25"> <!-- input field for stock -->
				<br> <br> <!-- creates two newlines -->
				<label for="customername"> <!-- sets a label for the customer input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-users"></i> <!-- adds an icon for the customer-->
				</label>  <!-- closes label section-->
				<input type="text" name="customername" placeholder="Name of customer in order" id="customername" required size="25"> <!-- input field for customer -->
				<br> <br> <!-- creates two newlines -->
				<label for="quantity"> <!-- sets a label for the quantity input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-layer-group"></i> <!-- adds an icon for the quantity-->
				</label>  <!-- closes label section-->
				<input type="number" name="quantity" placeholder="Order Quantity" id="quantity" required size="25"> <!-- input field for quantity -->
				<br> <br> <!-- creates two newlines -->
				<label for="password"> <!-- sets a label for the password input box -->
					<i class="fas fa-lock"> </i> <!-- adds a label for the password -->
				</label> <!-- closes label section-->
				<input type="password" name="password" placeholder="Password" id="password" required size="25"> <!-- input field for password -->
				<input type="submit" value="Add to system"> <!-- creates a submit button for this form -->
			</form> <!-- closes form -->

			<form action="ACTIONS/deleteorder.php" method="post" class="orderform"> <!-- creates a form that posts its data to the deleteorder.php file on submission -->
				<h1> Delete order </h1> <!-- h1 for text -->
				<label for="orderid"> <!-- sets a label for the stock id input box -->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-id-badge"></i> <!-- adds an icon for the id-->
				</label>  <!-- closes label section-->
				<input type="text" name="orderid" placeholder="Id of order to be deleted" id="orderid" required size="25"> <!-- input field for id -->
				<br> <br> <!-- creates two newlines -->
				<label for="password"> <!-- sets a label for the password input box -->
					<i class="fas fa-lock"> </i> <!-- adds a label for the password -->
				</label> <!-- closes label section-->
				<input type="password" name="password" placeholder="Password" id="password" required size="25"> <!-- input field for password -->
				<input type="submit" value="Delete from system"> <!-- creates a submit button for this form -->
			</form> <!-- closes form -->

		</div> <!-- closes the div container -->
	</body> <!-- closes the body tag-->
</html> <!-- ends the HTML code -->