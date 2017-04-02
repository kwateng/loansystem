<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("models/generalloanshelper.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
if(!empty($_GET)){
    $id=$_GET["loan_id"];
    if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id) || isAccountant($loggedInUser->user_id)) {
        $loan=getInstantLoanById($id);
    } else {
        $loan=getInstantLoanById($id);
        if(!$loan->member_id==$loggedInUser->user_id) {
            header("Location: unauthorize.php");
            die();
        }
    }
}

if(!empty($_POST)) {
    $id=$_POST["loan_id"];
    $status=$_POST["status"];
    updateLoan($id,$status);
    header("Location: view_instant_loan.php?loan_id=".$id);
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
            <h3>Edit instant Loan Details: Member_ID-<?=$loan->member_id?></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Id</span><input class="contact" type="text" name="loan_id" value="<?=$loan->loan_id?>" readonly/></p>
                    <p><span>Member Id</span><input class="contact" type="text" name="member_id" value="<?=$loan->member_id?>" readonly/></p>
                    <p><span>Loan Type</span><input class="contact" type="text" name="loan_type" value="<?=$loan->loan_type?>" readonly/></p>
                    <p><span>Duration</span><input class="contact" type="text" name="duration" value="<?=$loan->duration?>" readonly/></p>
                    <p><span>Gurantor1 Id</span><input class="contact" type="text" name="gurantor_id1" value="<?=$loan->gurantor_id1?>" readonly/></p>
                    <p><span>Gurantor1 status</span><input class="contact" type="text" name="gurantor1_status" value="<?=$loan->gurantor1_status?>" readonly/></p>
                    <p><span>Gurantor2 Id</span><input class="contact" type="text" name="gurantor_id2" value="<?=$loan->gurantor_id2?>" readonly/></p>
                    <p><span>Gurantor2 status</span><input class="contact" type="text" name="gurantor2_status" value="<?=$loan->gurantor2_status?>" readonly/></p>
                    <p><span>Amount</span><input class="contact" type="text" name="amount" value="<?=$loan->amount?>" readonly/></p>
                    <p><span>Placed Date</span><input class="contact" type="text" name="placed_date" value="<?=$loan->placed_date?>" readonly/></p>
                    <p><span>Status</span>
                        <select name="status">
                            <option name="APPROVED" <?php if($loan->status=="APPROVED"){echo 'selected';}?>>APPROVED</option>
                            <option name="ISSUED" <?php if($loan->status=="ISSUED"){echo 'selected';}?>>ISSUED</option>
                            <option name="COMPLETED" <?php if($loan->status=="COMPLETED"){echo 'selected';}?>>COMPLETED</option>
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