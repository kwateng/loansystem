<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
//Log the user out
if(isUserLoggedIn())
{
	$loggedInUser->userLogOut();
}
header("Location: index.php")
?>

