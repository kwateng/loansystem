<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("add_new_festival_loan.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
    $errors = array();
    if(count($errors)==0) {
        $festival=new FestivalLaon($loggedInUser->user_id,"CHRISTMAS");
        $loan_id = $festival->addFestivalLoan();
        if ($loan_id == null) {
            $errors[] = "Fail to add loan";
        } else {
            header("Location: view_festival_loan.php?loan_id=" . $loan_id);
        }
    }
?>