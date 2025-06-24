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
$result = mysqli_query($connection, "SELECT * FROM stocks"); //connect to database and get results 
$result2 = mysqli_query($connection, "SELECT * FROM suppliers"); //connects to teh database and gets results

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
		<link id="pagestyle" rel="stylesheet" href="style.css?rnd=132"  type="text/css"> <!-- connects the page to a stylesheet for the layout/colouring of the page-->
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
			<h2>Stocks (Admin)</h2> <!-- creates a H2 text box -->
			<?php //starts php code block
				
				echo '<table class="data-table" style = "color: #000000;"> 
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
				
				echo '<table class="data-table"> 
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

				<form action="ACTIONS/newstock.php" method="post" class="stockform"> <!-- creates a form that posts its data to the newstock.php file on submission -->
				<h1> Add stock to system </h1> <!-- h1 for text -->
				<label for="newstock"> <!-- sets a label for the new stock input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-box"></i> <!-- adds an icon for the stock-->
				</label> <!-- closes label section-->
				<input type="text" name="newstock" placeholder="Name of new stock" id="newstock" required size="25"> <!-- input field for new stock -->
				<br> <br> <!-- creates two newlines -->
				<label for="newingredients"> <!-- sets a label for the new ingredients input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-clipboard-list"></i> <!-- adds an icon for the ingredients-->
				</label>  <!-- closes label section-->
				<input type="text" name="newingredients" placeholder="ingredients for new stock" id="newingredients" required size="25"> <!-- input field for new ingredients -->
				<br> <br> <!-- creates two newlines -->
				<label for="newprice"> <!-- sets a label for the new price input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-coins"></i> <!-- adds an icon for the price-->
				</label>  <!-- closes label section-->
				<input type="text" name="newprice" placeholder="Price for new stock" id="newprice" required size="25"> <!-- input field for new price -->
				<br> <br> <!-- creates two newlines -->
				<label for="newamount"> <!-- sets a label for the new amount input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-file-lines"></i> <!-- adds an icon for the amount-->
				</label>  <!-- closes label section-->
				<input type="text" name="newamount" placeholder="Amount of new stock" id="newamount" required size="25"> <!-- input field for new amount -->
				<br> <br>
				<label for="supplierid"> <!-- sets a label for the supplier id input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-truck"></i> <!-- adds an icon for the supplier-->
				</label>  <!-- closes label section-->
				<input type="text" name="supplierid" placeholder="ID of stocks' supplier" id="supplierid" required size="25"> <!-- input field for supplierid -->
				<br> <br>
				<label for="adminpass"> <!-- sets a label for the admin password input box -->
					<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
				</label> <!-- closes label section-->
				<input type="password" name="adminpass" placeholder="Admin Password" id="adminpass" required> <!-- input field for admin password -->
				<input type="submit" value="Add to system"> <!-- creates a submit button for this form -->
			</form> <!-- closes form -->
			
			<form action="ACTIONS/deletestock.php" method="post" class="customerform"> <!-- creates a form that posts its data to the deletestock.php file on submission -->
				<h1> Delete stock from system </h1> <!-- h1 for text -->
				<label for="deletestock"> <!-- sets a label for the delete stock input box-->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-box"></i> <!-- adds an icon for the stock-->
				</label> <!-- closes label section-->
				<input type="text" name="deletestock" placeholder="Name of deleted stock" id="deletestock" required size="25"> <!-- input field for deleted stock -->
				<br> <br> <!-- creates two newlines -->
				<label for="deleteid"> <!-- sets a label for the new password input box-->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-id-badge"></i> <!-- adds an icon for the id-->
				</label>  <!-- closes label section-->
				<input type="text" name="deleteid" placeholder="ID of deleted stock" id="deleteid" required size="25"> <!-- input field for deleted id-->
				<br> <br> <!-- creates two newlines -->
				<label for="adminpass"> <!-- sets a label for the admin password input box -->
					<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
				</label> <!-- closes label section-->
				<input type="password" name="adminpass" placeholder="Admin Password" id="adminpassword" required> <!-- input field for admin password -->
				<input type="submit" value="Delete from system"> <!-- creates a submit button for this form --> 
			</form> <!-- closes form -->	

			<form action="ACTIONS/addsupplier.php" method="post" class="supplierform"> <!-- creates a form that posts its data to the addsuplier.php file on submission -->
				<h1> Add supplier to system </h1> <!-- h1 for text -->
				<label for="addsupplier"> <!-- sets a label for the add supplier input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-truck"></i> <!-- adds an icon for the supplier-->
				</label> <!-- closes label section-->
				<input type="text" name="addsupplier" placeholder="Name of new supplier" id="addsupplier" required size="25"> <!-- input field for added supplier -->
				<br> <br> <!-- creates two newlines -->
				<label for="addpostcode"> <!-- sets a label for the new postcode input box-->
					<i class="fas fa-plus"></i> <!-- adds a plus icon -->
					<i class="fas fa-map-location-dot"></i> <!-- adds an icon for the postcode-->
				</label>  <!-- closes label section-->
				<input type="text" name="addpostcode" placeholder="Postcode of new supplier" id="addpostcode" required size="25"> <!-- input field for postcode-->
				<br> <br> <!-- creates two newlines -->
				<label for="adminpass"> <!-- sets a label for the admin password input box -->
					<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
				</label> <!-- closes label section-->
				<input type="password" name="adminpass" placeholder="Admin Password" id="adminpassword" required> <!-- input field for admin password -->
				<input type="submit" value="Add to system"> <!-- creates a submit button for this form --> 
			</form> <!-- closes form -->	

			<form action="ACTIONS/deletesupplier.php" method="post" class="supplierform"> <!-- creates a form that posts its data to the deletestock.php file on submission -->
				<h1> Remove supplier from system </h1> <!-- h1 for text -->
				<label for="deletesupplier"> <!-- sets a label for the add suplier input box-->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-truck"></i> <!-- adds an icon for the stock-->
				</label> <!-- closes label section-->
				<input type="text" name="deletesupplier" placeholder="Name of deleted supplier" id="deletesupplier" required size="25"> <!-- input field for deleted stock -->
				<br> <br> <!-- creates two newlines -->
				<label for="deleteid"> <!-- sets a label for the new postcode input box-->
					<i class="fas fa-minus"></i> <!-- adds a minus icon -->
					<i class="fas fa-id-badge"></i> <!-- adds an icon for the id-->
				</label>  <!-- closes label section-->
				<input type="text" name="deleteid" placeholder="ID of deleted supplier" id="deleteid" required size="25"> <!-- input field for deleted id-->
				<br> <br> <!-- creates two newlines -->
				<label for="adminpass"> <!-- sets a label for the admin password input box -->
					<i class="fas fa-user-tie"> </i> <!-- adds a label for the admin password -->
				</label> <!-- closes label section-->
				<input type="password" name="adminpass" placeholder="Admin Password" id="adminpassword" required> <!-- input field for admin password -->
				<input type="submit" value="Delete from system"> (ENSURE ALL STOCKS FROM THIS SUPPLIER HAVE BEEN DELETED) <!-- creates a submit button for this form --> 
			</form> <!-- closes form -->


		</div> <!-- closes the div container -->
	</body> <!-- closes the body tag-->
</html> <!-- ends the HTML code -->