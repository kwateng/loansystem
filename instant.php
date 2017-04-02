<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("add_new_general_loan.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

//Forms posted
if(!empty($_POST))
{
    $errors = array();
    $amount= trim($_POST["loan_amount"]);
    $gurantor1 = trim($_POST["gurantor_id_1"]);
    $gurantor2 = trim($_POST["gurantor_id_2"]);
    $duration = trim($_POST["duration"]);
    $monthly_installement=$amount/$duration;
    if($gurantor1==$gurantor2)
    {
        $errors[] = lang("SAME GURANTOR ID",array(5,25));
    }
    if(!gurantorExists($gurantor1))
    {
        $errors[] = lang("GUARANTOR 1 ID NOT EXIST",array(5,100));
    }
    if(!gurantorExists($gurantor2))
    {
        $errors[] = lang("GUARANTOR 2 ID NOT EXIST",array(5,100));
    }
    if(count($errors)==0) {
        $loan=new GeneralLoan($loggedInUser->user_id,$duration,$amount,$gurantor1,$gurantor2,$monthly_installement);
        $loan->addInstantLoan();
        $loan_id=$loan->addGeneralLoan();
        if($loan_id==null)
        {
            $errors[] = "Fail to add loan";
        } else {
            header("Location: view_instant_loan.php?loan_id=".$loan_id);
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'models/header.php';?>

<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <?php
    echo resultBlock($errors,$successes);
    ?>
    <div id="site_content">
        <?php include 'sidebar.php';?>
        <script>
            $(".current").removeClass("current");
            $( "#generalloans" ).addClass( "current" );
        </script>
        <div id="content">
            <!-- insert the page content here -->
            <h3 align="center">Place Instant Loan</h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Amount</span><input class="contact" type="text" name="loan_amount"/></p>
                    <p><span>Gurantor ID 1</span><input class="contact" type="text" name="gurantor_id_1"/></p>
                    <p><span>Gurantor ID 2</span><input class="contact" type="text" name="gurantor_id_1" /></p>
                    <p><span>Duration</span><input class="contact" type="text" name="duration" />Months</p>
                    <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" value="submit" /></p>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
​
</body>
</html>
