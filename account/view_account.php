<?php
require_once("../models/config.php");
require_once("../models/constants.php");
require_once("helper_functions.php");
require_once("user.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: ../login.php"); die(); }
if(!empty($_GET)){
    $id=$_GET["employee_id"];
    if(isAdmin($loggedInUser->user_id)) {
        $accout=getAccountDetails($id);
    } else if(isManager($loggedInUser->user_id)) {
        $accout=getAccountDetails($id);
    } else {
        header("Location: ../unauthorize.php");
        die();
    }
} else {
    $accout = getAccountDetails($loggedInUser->user_id);
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
                    <table width="600">
                        <tbody>
                        <tr>
                            <td>Member_Id</td>
                            <td><?=$accout->member_id?></td>
                        </tr>
                        <tr>
                            <td>Employee_Id</td>
                            <td><?=$accout->employee_id?></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td><?=$accout->full_name?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?=$accout->username?></td>
                        </tr>
                        <tr>
                            <td>Display Name</td>
                            <td><?=$accout->displayname?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?=$accout->address?></td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td><?=$accout->dsignation?></td>
                        </tr>
                        <tr>
                            <td>Salary</td>
                            <td><?=$accout->salary?></td>
                        </tr>
                        <tr>
                            <td>Service</td>
                            <td><?=$accout->service?></td>
                        </tr>
                        <tr>
                            <td>Mobile_No</td>
                            <td><?=$accout->mobile_no?></td>
                        </tr>
                        <tr>
                            <td>Land_No</td>
                            <td><?=$accout->land_no?></td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td><?=$accout->clean_email?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td><?=$accout->role?></td>
                        </tr>
                        </tbody>
                        </table>
                    <p><a href="edit_account.php?member_id=<?=$accout->member_id?>">Edit Profile</a>
                    <?php
                    if($loggedInUser->user_id==$accout->member_id) {
                        echo "|<a href='change-password.php'>Change Password</a>";
                    }
                    if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
                        echo "|<a href='../view_my_loans.php?member_id=".$accout->member_id."'>View Loans</a>";
                    }
                    ?></p>
                </div>
            </form>
        </div>
    </div>
    <?php include '../footer.php';?>
</div>
</body>
</html>