<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

//Forms posted
if(!empty($_POST))
{
    $errors = array();
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $displayname = trim($_POST["displayname"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["passwordc"]);
    //$captcha = md5($_POST["captcha"]);
    $employee_id=$_POST["employee_id"];
    $full_name=$_POST["full_name"];
    $address=$_POST["address"];
    $dsignation=$_POST["designation"];
    $salary=$_POST["salary"];
    $service=$_POST["service"];
    $role=$_POST["role"];
    $mobile_no=$_POST["mobile_no"];
    $land_no=$_POST["land_no"];


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
    if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
    {
        $errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
    }
    else if($password != $confirm_pass)
    {
        $errors[] = lang("ACCOUNT_PASS_MISMATCH");
    }
    if(!isValidEmail($email))
    {
        $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }
    //End data validation
    if(count($errors) == 0)
    {
        //Construct a user object
        $user = new User($username,$displayname,$password,$email,$dsignation,$salary,$mobile_no,$land_no,$service,$employee_id,$address,$full_name,$role);

        //Checking this flag tells us whether there were any errors such as possible data duplication occured
        if(!$user->status)
        {
            if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
            if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
            if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
        }
        else
        {
            //Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
            if(!$user->userAddUser())
            {
                if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
                if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
            }
        }
    }
    if(count($errors) == 0) {
        header("Location: thankyou.php");
    }
}
?>
<!DOCTYPE HTML>
<html>

<?php include 'models/header.php';?>

<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <?php
    echo resultBlock($errors,$successes);
    ?>
    <script>
        $(".current").removeClass("current");
        $( "#register" ).addClass( "current" );
    </script>
    <div id="site_content">
        <?php include 'sidebar.php';?>
        <div id="content">
            <!-- insert the page content here -->
            <h3 align="center">Register a member</h3>
                <form method="post">
                    <div class="form_settings">
                        <p><span>Employee_Id</span><input class="contact" type="text" name="employee_id"/></p>
                        <p><span>Full Name</span><input class="contact" type="text" name="full_name"/></p>
                        <p><span>Username</span><input class="contact" type="text" name="username" /></p>
                        <p><span>Display Name</span><input class="contact" type="text" name="displayname" /></p>
                        <p><span>Address</span><input class="contact" type="text" name="address" /></p>
                        <p><span>Designation</span><input class="contact" type="text" name="designation"/></p>
                        <p><span>Password</span><input class="contact" type="password" name="password"/></p>
                        <p><span>Re-Password</span><input class="contact" type="password" name="passwordc"/></p>
                        <p><span>Salary</span><input class="contact" type="text" name="salary"/></p>
                        <p><span>Service</span><input class="contact" type="text" name="service"/>Months</p>
                        <p><span>Role</span>
                            <select name="role">
                                <option name="employee" selected>Employee</option>
                                <option name="accountant">Accountant</option>
                                <option name="manager">Manager</option>
                            </select></p>
                        <p><span>Mobile_No</span><input class="contact" type="text" name="mobile_no"/></p>
                        <p><span>Land_No</span><input class="contact" type="text" name="land_no"/></p>
                        <p><span>Email Address</span><input class="contact" type="text" name="email"/></p>
                        <!--<p>
                        <label>Security Code:</label>
                        <img src='models/captcha.php'>
                        </p>
                        <p>
                            <span>Enter Security Code:</span>
                            <input name='captcha' type='text'>
                        </p>
                        <label>&nbsp;<br>-->
                        <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" value="submit" /></p>
                    </div>
                </form>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
