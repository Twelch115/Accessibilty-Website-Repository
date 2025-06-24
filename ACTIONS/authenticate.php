<?php //begins PHP code
session_start(); //initialises a session

$DATABASE_HOST = 'localhost'; //sets the variable database_host
$DATABASE_USER = 'root'; //sets the variable database_user
$DATABASE_PASS = ''; //sets the variable database_pass
$DATABASE_NAME = '92DK'; //sets the variable database_name

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); //attempts to connect to a dataabase using the above variables data
if ( mysqli_connect_errno() ) { //IF this connection attempt fails
	
	exit('Failed to connect to MySQL: ' . mysqli_connect_error()); //exit script with this error message
}

if ( !isset($_POST['username'], $_POST['password']) ) { //IF username or password were not filled in
	exit('Please fill both the username and password fields!'); //exit script with this error message
}

if ($stmt = $con->prepare('SELECT Acc_id, Acc_password, Acc_level FROM accounts WHERE Acc_username = ?')) { //creates an SQL statement to select data from the accounts table where the username is the form input
	$stmt->bind_param('s', $_POST['username']); //attatches the form input to the above sql statement where the "?" is
	$stmt->execute(); //executes the sql statement 

	$stmt->store_result(); //stores the result of this statement for later use

    if ($stmt->num_rows > 0) { //IF the result has a number of rows greater than 0
        $stmt->bind_result($id, $password, $level); //bind the id/password/level from the database to this statement
        $stmt->fetch(); //return the stored results from above

        if ($_POST['password'] === $password) { //IF the password of the form is the same as the one for this account
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id(); //recreate session
            $_SESSION['loggedin'] = TRUE; //session is logged in
            $_SESSION['name'] = $_POST['username']; //session is named after username
            $_SESSION['id'] = $id; //session has this id
            $_SESSION['isadmin'] = $level; //session has this variable for user level
            header('Location: ../home.php'); //forwards the user to the home.php page
        } else { //if the password wasn't correct 
            // Incorrect password
            echo 'Incorrect password!  <a href="../home.php">click here to try again.</a>'; //display error message
        }
    } else { //if the username doesn't match
        echo 'Incorrect username! <a href="../home.php">click here to try again.</a>'; //display error message
    }

	$stmt->close(); //closes the statement
}

?>  <!-- end php code -->