<?php
require_once("../models/config.php");
require_once("../models/constants.php");
require_once("helper_functions.php");
require_once("user.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: ../login.php"); die(); }
if(!empty($_POST)){
    $errors = array();
    $successes=array();
    $oldpass = trim($_POST["oldpassword"]);
    $newpass = trim($_POST["password"]);
    $confirmpass = trim($_POST["passwordc"]);
    if(minMaxRange(8,50,$newpass) && minMaxRange(8,50,$confirmpass))
    {
        $errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
    }

    if(!$newpass==$confirmpass){
        $errors[]="Passwords not matched";
    }

    $userdetails = fetchUserDetails($loggedInUser->username);
    //Hash the password and use the salt from the database to compare the password.
    $old_pass = generateHash($oldpass, $userdetails["password"]);
    if ($old_pass != $userdetails["password"]) {
        $errors[] = "Incorrect old password";
    } else {
        updatePassword($newpass,$loggedInUser->user_id);
        $successes[]="Successfully changed the password";
        header("Location: change-password.php");
    }


}
?>
<!DOCTYPE HTML>
<html>
<?php include 'my_account_header.php';?>
<body>
<?php
echo resultBlock($errors,$successes);
?>
<div id="main">
    <?php include 'account_top_nav.php';?>
    <div id="site_content">
        <?php include '../sidebar.php';?>
        <script>
            $(".current").removeClass("current");
            $( "#myaccounnt" ).addClass( "current" );
        </script>
        <div id="content">
            <h3>Account Details-<?=$loggedInUser->username?></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Old Password</span><input class="contact" type="password" name="oldpassword"/></p>
                    <p><span>Password</span><input class="contact" type="password" name="password"/></p>
                    <p><span>Re-Password</span><input class="contact" type="password" name="passwordc"/></p>
                    <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" value="submit" /></p>
                </div>
            </form>
        </div>
    </div>
    <?php include '../footer.php';?>
</div>
</body>
</html>