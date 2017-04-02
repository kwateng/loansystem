<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("models/generalloanshelper.php");
require_once("account/user.php");
require_once("account/helper_functions.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
if(!empty($_GET)){
    $id=$_GET["loan_id"];
    $loan=getGeneralLoanById($id);
    $status;
    $statusValue;
    $member=getAccountDetails($loggedInUser->user_id);
    if($loan->gurantor1_id==$member->member_id && $loan->gurantor2_id==$member->member_id){
        header("Location: unauthorize.php");
        die();
    }
    if($loan->gurantor1_id==$member->member_id) {
     $status="gurantor1_status";
     $statusValue=$loan->gurantor1_status;
    }
    if($loan->gurantor2_id==$member->member_id) {
        $status="gurantor2_status";
        $statusValue=$loan->gurantor2_status;

    }
}

if(!empty($_POST)) {
    $id=$_POST["loan_id"];
    $gurantor_status=$_POST["gurantor1_status"];
    if($gurantor_status!=null || $gurantor_status!=""){
        updateLoanGurantor1Status($id,$gurantor_status);
    } else {
        $gurantor_status=$_POST["gurantor2_status"];
        updateLoanGurantor2Status($id,$gurantor_status);
    }
    $status=$_POST["status"];
    updateLoan($id,$status);
    header("Location: loan_gurantor_action.php?loan_id=".$id);
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
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Id</span><input class="contact" type="text" name="loan_id" value="<?=$loan->loan_id?>" readonly/></p>
                    <p><span>Member Id</span><input class="contact" type="text" name="member_id" value="<?=$loan->member_id?>" readonly/></p>
                    <p><span>Loan Type</span><input class="contact" type="text" name="loan_type" value="<?=$loan->loan_type?>" readonly/></p>
                    <p><span>Duration</span><input class="contact" type="text" name="duration" value="<?=$loan->duration?>" readonly/></p>
                    <p><span>Amount</span><input class="contact" type="text" name="amount" value="<?=$loan->amount?>" readonly/></p>
                    <p><span>Placed Date</span><input class="contact" type="text" name="placed_date" value="<?=$loan->placed_date?>" readonly/></p>
                    <p><span>Status</span>
                        <select name="<%$status%>">
                            <option name="APPROVED" <?php if($statusValue=="APPROVED"){echo 'selected';}?>>APPROVED</option>
                            <option name="REJECTED" <?php if($loan->status=="REJECTED"){echo 'selected';}?>>REJECTED</option>
                            <option name="PENDING" <?php if($loan->status=="PENDING"){echo 'selected';}?>>PENDING</option>
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