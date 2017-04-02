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
    $type=$_GET["loan_type"];
        if($type=="distress") {
            $loan = getDistressLoanById($id);
        } else if ($type=="ordinary") {
            $loan = getOrdinaryLoanById($id);
        } else if ($type=="instant") {
            $loan = getInstantLoanById($id);
        }
    $my_details=getAccountDetails($loggedInUser->user_id);

    if($loan->gurantor_id1!=$my_details->employee_id && $loan->gurantor_id2!=$my_details->employee_id) {
        header("Location: unauthorize.php");
        die();
    }

    $employee_details=getAccountDetails($loan->member_id);
    $gurantor_status;
    $gurantor;

    if($loan->gurantor_id2==$my_details->employee_id) {
        $gurantor="1";
        $gurantor_status=$loan->gurantor1_status;
    }

    if($loan->gurantor_id1==$my_details->employee_id) {
        $gurantor="2";
        $gurantor_status=$loan->gurantor2_status;
    }
}

if(!empty($_POST)) {
    $id=$_POST["loan_id"];
    $status=$_POST["status"];
    $gurantor=$_POST["gurantor"];
    if($gurantor=="1") {
        updateLoanGurantor1Status($id,$status);
    } else if($gurantor=="2") {
        updateLoanGurantor2Status($id,$status);
    }
    header("Location: requests_gurantee.php");
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
            $( "#loanreq" ).addClass( "current" );
        </script>
        <div id="content">
            <h3>Loan Details: Member_ID-<?=$loan->member_id?></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Id</span><input class="contact" type="text" name="loan_id" value="<?=$loan->loan_id?>" readonly/></p>
                    <p><span>Member Name</span><input class="contact" type="text" name="member_id" value="<?=$employee_details->displayname?>" readonly/></p>
                    <p><span>Member Id</span><input class="contact" type="text" name="member_name" value="<?=$loan->member_id?>" readonly/></p>
                    <p><span>Loan Type</span><input class="contact" type="text" name="loan_type" value="<?=$loan->loan_type?>" readonly/></p>
                    <p><span>Amount</span><input class="contact" type="text" name="amount" value="<?=$loan->amount?>" readonly/></p>
                    <input type="hidden" name="gurantor" value="<?=$gurantor?>"/>
                    <p><span>Placed Date</span><input class ="contact" type="text" name="placed_date" value="<?=$loan->placed_date?>" readonly/></p>
                    <p><span>Current Gurantor Status</span><input class="contact" type="text" name="placed_date" value="<?=$gurantor_status?>" readonly/></p>
                    <p><span>Gurantor status</span>
                        <select name="status">
                            <option name="APPROVED">APPROVED</option>
                            <option name="CANCELLED">REJECTED</option>
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