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
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $displayname = trim($_POST["displayname"]);
    $full_name=$_POST["full_name"];
    $address=$_POST["address"];
    $mobile_no=$_POST["mobile_no"];
    $land_no=$_POST["land_no"];
    $role=$_POST["role"];
    $service=$_POST["service"];
    $salary=$_POST["salary"];
    $designation=$_POST["designation"];
    $member_id=$loggedInUser->user_id;

    /* if ($captcha != $_SESSION['captcha'])
     {
         $errors[] = lang("CAPTCHA_FAIL");
     }*/
    if(minMaxRange(5,25,$username))
    {
        $errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
    }
    if(!ctype_alnum($username)){
        $errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
    }
    if(minMaxRange(5,25,$displayname))
    {
        $errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
    }
    if(!ctype_alnum($displayname)){
        $errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
    }
    if(!isValidEmail($email))
    {
        $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }
//End data validation
    if(count($errors) == 0)
    {

        $user =new UserAccount();
        $user->clean_email=$email;
        $user->address=$address;
        $user->full_name=$full_name;
        $user->displayname=$displayname;
        $user->username=$username;
        $user->land_no=$land_no;
        $user->mobile_no=$mobile_no;
        $user->member_id=$member_id;
        $user->role=$role;
        $user->dsignation=$designation;
        $user->salary=$salary;
        $user->service=$service;
        if(isAdmin($loggedInUser->user_id)||isManager($loggedInUser->user_id)){
             updateAdminOrManagerAccount($user);
        } else {
            updateMemberAccount($user);
        }
        header("Location: view_account.php");
    }
} else if(!empty($_GET)){
    $id=$_GET["member_id"];
    $accout=getAccountDetails($id);
    if(!$loggedInUser->user_id==$accout-$member_id) {
        if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
            header("Location: ../unauthorize.php");
            die();
        }
    }
} else {

}
?>
<!DOCTYPE HTML>
<html>
<?php include 'my_account_header.php';?>
<body>
<div id="main">
    <?php include 'account_top_nav.php';?>
    <div id="site_content">
        <?php include '../sidebar.php';?>
        <script>
            $(".current").removeClass("current");
            $( "#myaccounnt" ).addClass( "current" );
        </script>
        <div id="content">
            <h3>Account Details-<?=$accout->username?></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Member_Id</span><input class="contact" type="text" name="member_id" readonly value="<?=$accout->member_id?>"/></p>
                    <p><span>Employee_Id</span><input class="contact" type="text" name="employee_id" readonly value="<?=$accout->employee_id?>"/></p>
                    <p><span>Full Name</span><input class="contact" type="text" name="full_name" value="<?=$accout->full_name?>"/></p>
                    <p><span>Username</span><input class="contact" type="text" name="username" value="<?=$accout->username?>"/></p>
                    <p><span>Display Name</span><input class="contact" type="text" name="displayname" value="<?=$accout->displayname?>"/></p>
                    <p><span>Address</span><input class="contact" type="text" name="address" value="<?=$accout->address?>"/></p>
                    <p><span>Mobile_No</span><input class="contact" type="text" name="mobile_no" value="<?=$accout->mobile_no?>"/></p>
                    <p><span>Land_No</span><input class="contact" type="text" name="land_no" value="<?=$accout->land_no?>"/></p>
                    <p><span>Email Address</span><input class="contact" type="text" name="email" value="<?=$accout->clean_email?>"/></p>
                    <?php
                    if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
                        echo  "<p><span>Designation</span><input class='contact' type='text' name='designation' value='$accout->dsignation'/></p>";
                        echo  "<p><span>Salary</span><input class='contact' type='text' name='salary' value='$accout->salary'/></p>";
                        echo  "<p><span>Service</span><input class='contact' type='text' name='service' value='$accout->service'/></p>";
                        echo  "<p><span>Role</span><input class='contact' type='text' name='role' value='$accout->role'/></p>";
                    }
                    ?>
                    <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" value="submit" /></p>
                </div>
            </form>
        </div>
    </div>
    <?php include '../footer.php';?>
</div>
</body>
</html>