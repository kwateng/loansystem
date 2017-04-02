<?php
require_once("../models/config.php");
require_once("../models/constants.php");
require_once("helper_functions.php");
require_once("user.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: ../login.php"); die(); }
if(!empty($_GET)) {
    $id = $_GET["employee_id"];
    $accout = getAccountDetails($id);
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
                    <p><span>Employee_Id</span><?=$accout->employee_id?></p>
                    <p><span>Full Name</span><?=$accout->full_name?></p>
                    <p><span>Address</span><?=$accout->address?></p>
                    <p><span>Mobile_No</span><?=$accout->mobile_no?></p>
                    <p><span>Land_No</span><?=$accout->land_no?></p>
                    <p><span>Email Address</span><?=$accout->clean_email?></p>
                </div>
            </form>
        </div>
    </div>
    <?php include '../footer.php';?>
</div>
</body>
</html>