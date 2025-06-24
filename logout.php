<?php //starts the php code
session_start(); //begins the session
session_destroy(); //destroys the session, and the users logged in status

header('Location: index.html'); //redirects to the index page
?> <!-- ends php code -->