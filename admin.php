<?php //begins PHP code
session_start(); //initialises a session

if (!isset($_SESSION['loggedin'])) { //IF the session does NOT have the loggedin paramiter from authenticate.php
	header('Location: index.html'); //Redirect to the index page
	exit; //exit code
}

$isadmin = $_SESSION['isadmin']; //sets the isadmin session value as a variable for use in below if
if ($isadmin == 0) { //IF the isadmin variable isn't 1
    echo ' You are not an admin! <a href="home.php">click here to return to home</a>'; //display this text/link instead of the main page
	exit; //exit code
}

$host    = "localhost"; //host of database
$user    = "root"; //database user
$pass    = ""; //database password
$db_name = "92DK"; //databasename
$connection = mysqli_connect($host, $user, $pass, $db_name); //connect to a database with the above credentials
$result = mysqli_query($connection, "SELECT * FROM accounts"); //connect to database and get results 
$result2 = mysqli_query($connection, "SELECT * FROM locations"); //connect to database and get results

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
		<link id="pagestyle" href="style.css?rnd=132" rel="stylesheet" type="text/css"> <!-- connects the page to a stylesheet for the layout/colouring of the page-->
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
			<h2>Admin</h2> <!-- creates a H2 text box -->
				<?php //starts php code block
					echo '<table class="data-table" style = "box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1); margin: 25px 0; padding: 25px; background-color: #fff; width: 100%;">
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

					echo '<table class="data-table" style = "box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1); margin: 25px 0; padding: 25px; background-color: #fff; width: 100%;">
        			<tr class="data-heading">';  //initialize a table for the database data and initialize table row tag for the title row
					while ($property = mysqli_fetch_field($result2)) { //while there is data in the results variable
    					echo '<td>' . htmlspecialchars($property->name) . '</td>';  //use a row name as a table data
					}
					echo '</tr>'; //end table row tag for the title row

					while ($row = mysqli_fetch_row($result2)) { //while there is data in the results variable
    					echo "<tr>"; //start a row 
    					foreach ($row as $item) { //for each item as a row
        					echo '<td>' . htmlspecialchars($item) . '</td>'; //create a table entry for each item
    					}
    				echo '</tr>'; //closes table row tag for one item set
					}
					echo "</table>"; //closes table
				?> <!-- ends php code block -->
                
                <form action="ACTIONS/newuser.php" method="post" class="adminform"> <!-- creates a form that posts its data to the newuser.php file on submission -->
					<h1> Add user to system </h1> <!-- h1 for text -->
					<label for="newusername"> <!-- sets a label for the new username input box-->
						<i class="fas fa-plus"></i> <!-- adds a plus icon -->
						<i class="fas fa-user"></i> <!-- adds an icon for the username-->
					</label> <!-- closes label section-->
					<input type="text" name="newusername" placeholder="Username for New User" id="newusername" required size="25"> <!-- input field for new username -->
					<br> <br> <!-- creates two newlines -->
					<label for="newpassword"> <!-- sets a label for the new password input box-->
						<i class="fas fa-plus"></i> <!-- adds a plus icon -->
						<i class="fas fa-lock"></i> <!-- adds an icon for the password-->
					</label>  <!-- closes label section-->
					<input type="text" name="newpassword" placeholder="Password for new user" id="newpassword" required size="25"> <!-- input field for new password -->
					<br> <br> <!-- creates two newlines -->
					<label for="newemail"> <!-- sets a label for the new email input box-->
						<i class="fas fa-plus"></i> <!-- adds a plus icon -->
						<i class="fas fa-envelope"></i> <!-- adds an icon for the email-->
					</label>  <!-- closes label section-->
					<input type="text" name="newemail" placeholder="Email for new user" id="newemail" required size="25"> <!-- input field for new email -->
					<br> <br> <!-- creates two newlines -->
					<label for="newlocid"> <!-- sets a label for the new location id input box-->
						<i class="fas fa-plus"></i> <!-- adds a plus icon -->
						<i class="fas fa-building"></i> <!-- adds an icon for the location-->
					</label>  <!-- closes label section-->
					<input type="text" name="newlocid" placeholder="Location ID for new user" id="newlocid" required size="25"> <!-- input field for new location -->
					<br> <br> <!-- creates two newlines -->
					<input type="radio" id="noadmin" name="isadmin" value="1"> <!-- creates a radio button called isadmin, with the value 1-->
					<label for="yesadmin">This user is an admin</label> <!-- creates a label for the yesadmin button-->
					<input type="radio" id="yesadmin" name="isadmin" value="0"> <!-- creates a radio button called isadmin, with the value 0-->
					<label for="noadmin">This user is not an admin</label> <!-- creates a label for the nosadmin button-->
					<br> <br> <!-- creates two newlines -->
					<!-- <input type="radio" id="nomail" name="doemail" value="1"> creates a radio button called nomail, with the value 1-->
					<!-- <label for="yesadmin">email this user about their account creation </label>  creates a label for the nomail button-->
					<!-- <input type="radio" id="yesmail" name="doemail" value="0"> creates a radio button called yesmail, with the value 0-->
					<!-- <label for="noadmin">do not email this user about their account creation</label>  creates a label for the yesmail button-->
					<!-- <br> <br> -->	
					<label for="adminpass"> <!-- sets a label for the admin password input box -->
						<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
					</label> <!-- closes label section-->
					<input type="password" name="adminpass" placeholder="Admin Password" id="adminpass" required size="25"> <!-- input field for admin password -->
					<input type="submit" value="Add to system"> <!-- creates a submit button for this form -->
                </form> <!-- closes form -->
                
				<form action="ACTIONS/deleteuser.php" method="post" class="adminform"> <!-- creates a form that posts its data to the newuser.php file on submission -->
					<h1> Delete user from system </h1> <!-- h1 for text -->
					<label for="deleteuser"> <!-- sets a label for the delete username input box-->
						<i class="fas fa-minus"></i> <!-- adds a minus icon -->
						<i class="fas fa-user"></i> <!-- adds an icon for the username-->
					</label> <!-- closes label section-->
					<input type="text" name="deleteuser" placeholder="Username of Deleted User" id="deletuser" required size="25"> <!-- input field for deleted username -->
					<br> <br> <!-- creates two newlines -->
					<label for="deleteid"> <!-- sets a label for the new password input box-->
						<i class="fas fa-minus"></i> <!-- adds a minus icon -->
						<i class="fas fa-id-badge"></i> <!-- adds an icon for the id-->
					</label>  <!-- closes label section-->
					<input type="text" name="deleteid" placeholder="ID of deleted user" id="deleteid" required size="25"> <!-- input field for deleted id-->
					<br> <br> <!-- creates two newlines -->
					<label for="adminpass"> <!-- sets a label for the admin passowrd input box -->
						<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
					</label> <!-- closes label section-->
					<input type="password" name="adminpass" placeholder="Admin Password" id="adminpassword" required size="25"> <!-- input field for admin password -->
					<input type="submit" value="Delete from system"> <!-- creates a submit button for this form --> 
                </form> <!-- closes form -->
				
				<form action="ACTIONS/addlocation.php" method="post" class="locationform"> <!-- creates a form that posts its data to the addlocation.php file on submission -->
				<h1> Add location to system </h1> <!-- h1 for text -->
				<label for="addlocation"> <!-- sets a label for the add location input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-building"></i> <!-- adds an icon for the location-->
				</label> <!-- closes label section-->
				<input type="text" name="addlocation" placeholder="Name of new location" id="addlocation" required size="25"> <!-- input field for added location -->
				<br> <br> <!-- creates two newlines -->
				<label for="addpost"> <!-- sets a label for the new postcode input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-map-location-dot"></i> <!-- adds an icon for the postcode-->
				</label>  <!-- closes label section-->
				<input type="text" name="addpost" placeholder="Postcode of new location" id="addpost" required size="25"> <!-- input field for postcode-->
				<br> <br> <!-- creates two newlines -->
				<label for="adminpass"> <!-- sets a label for the admin password input box -->
					<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
				</label> <!-- closes label section-->
				<input type="password" name="adminpass" placeholder="Admin Password" id="adminpassword" required> <!-- input field for admin password -->
				<input type="submit" value="Add to system"> <!-- creates a submit button for this form --> 
			</form> <!-- closes form -->	

			<form action="ACTIONS/deletelocation.php" method="post" class="locationform"> <!-- creates a form that posts its data to the deletelocation.php file on submission -->
				<h1> Remove location from system </h1> <!-- h1 for text -->
				<label for="deletelocation"> <!-- sets a label for the delete location input box-->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-building"></i> <!-- adds an icon for the location-->
				</label> <!-- closes label section-->
				<input type="text" name="deletelocation" placeholder="Name of deleted location" id="deletelocation" required size="25"> <!-- input field for deleted location -->
				<br> <br> <!-- creates two newlines -->
				<label for="deleteid"> <!-- sets a label for the delete id input box-->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-id-badge"></i> <!-- adds an icon for the id-->
				</label>  <!-- closes label section-->
				<input type="text" name="deleteid" placeholder="ID of deleted location" id="deleteid" required size="25"> <!-- input field for deleted id-->
				<br> <br> <!-- creates two newlines -->
				<label for="adminpass"> <!-- sets a label for the admin password input box -->
					<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
				</label> <!-- closes label section-->
				<input type="password" name="adminpass" placeholder="Admin Password" id="adminpassword" required> <!-- input field for admin password -->
				<input type="submit" value="Delete from system"> (ENSURE ALL EMPLOYEES FROM THIS LOCATION HAVE BEEN DELETED) <!-- creates a submit button for this form --> 
			</form> <!-- closes form -->
				
		</div> <!-- closes the div container -->
	</body> <!-- closes the body tag-->
</html> <!-- ends the HTML code -->