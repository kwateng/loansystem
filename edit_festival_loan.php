<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("models/occationalloanhelper.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
if(!empty($_GET)){
    $id=$_GET["loan_id"];
    if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id) || isAccountant($loggedInUser->user_id)) {
        $loan=getFestivalAdvanceById($id);
    } else {
        $loan=getFestivalAdvanceById($id);
        if(!$loan->member_id==$loggedInUser->user_id) {
            header("Location: unauthorize.php");
            die();
        }
    }
}

if(!empty($_POST)) {
    $id=$_POST["loan_id"];
    $status=$_POST["status"];
    updateFestivalAdvance($id,$status);
    header("Location: view_festival_loan.php?loan_id=".$id);
}

?>
<!DOCTYPE HTML>
<html>
<?php include 'models/header.php';?>
<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <div id="site_content">
        <?php include 'sidebar.php';?>
        <script>
            $(".current").removeClass("current");
            $( "#generalloans" ).addClass( "current" );
        </script>
        <div id="content">
            <h3>Edit ordinary Loan: Member_ID-<a href="account/view_account.php?employee_id=<?=$loan->member_id?>"><?=$loan->member_id?></a></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Id</span><input class="contact" type="text" name="loan_id" value="<?=$loan->id?>" readonly/></p>
                    <p><span>Member Id</span><input class="contact" type="text" name="member_id" value="<?=$loan->member_id?>" readonly/></p>
                    <p><span>Loan Type</span><input class="contact" type="text" name="loan_type" value="<?=$loan->loan_type?>" readonly/></p>
                    <p><span>Loan Type</span><input class="contact" type="text" name="placed_date" value="<?=$loan->placed_date?>" readonly/></p>
                    <p><span>Status</span>
                        <select name="status">
                            <option name="APPROVED" <?php if($loan->status=="APPROVED"){echo 'selected';}?>>APPROVED</option>
                            <option name="ISSUED" <?php if($loan->status=="ISSUED"){echo 'selected';}?>>ISSUED</option>
                            <option name="COMPLETED" <?php if($loan->status=="COMPLETED"){echo 'selected';}?>>COMPLETED</option>
                            <option name="PENDING" <?php if($loan->status=="PENDING"){echo 'selected';}?>>PENDING</option>
                            <option name="CANCELLED" <?php if($loan->status=="CANCELLED"){echo 'selected';}?>>CANCELLED</option>
                        </select></p>
                    <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" value="submit" /></p>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>