<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("add_new_occational_loan.php");
require_once("helper_functions.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
//Forms posted
    if(!empty($_POST))
    {
        $errors = array();
        $id = trim($_POST["loan_id"]);
        $status = trim($_POST["status"]);
        updateOccationalLoanStatus($id,$status);
        header("Location: view_schol_gceal.php?loan_id=".$id);
    }
    if(!empty($_GET)){
        $id=$_GET["loan_id"];
        $schol=getOccationalLoanById($id);
    }
} else {
    header("Location: unauthorize.php");
    die();
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
        <div id="content">
            <h3>Scholarship AL Loan Details: Member ID- <a href="account/view_account.php?employee_id=<?=$loan->member_id?>"><?=$loan->member_id?></a></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Id</span><input class="contact" type="text" name="loan_id" value="<?=$schol->id?>" readonly/></p>
                    <p><span>Member Id</span><input class="contact" type="text" name="member_id" value="<?=$schol->member_id?>" readonly/></p>
                    <p><span>Child Name</span><input class="contact" type="text" value="<?=$schol->dependent_name?>" readonly name="child_name"/></p>
                    <p><span>School/Institute</span><input class="contact" type="text" value="<?=$schol->school?>" readonly name="school_institute"/></p>
                    <p><span>Date of Birth</span><input class="contact" type="text" value="<?=$schol->date_of_birth?>" readonly name="date_of_birth"/></p>
                    <p><span>Exam Index Number</span><input class="contact" type="text" value="<?=$schol->examination_no?>" readonly name="exam_index"/></p>
                    <p><span>Island Rank</span><input class="contact" type="text" value="<?=$schol->rank?>" readonly name="island_rank"/></p>
                    <p><span>Exam Attempt Year</span><input class="contact" type="text" value="<?=$schol->year?>" readonly name="attempt_year"/></p>
                    <p><span>No of Attempts</span><input class="contact" type="text" value="<?=$schol->no_of_attempts?>" readonly name="no_attempta"/></p>
                    <p><span>Loan Amount</span><input class="contact" type="text" value="<?=$schol->amount?>" readonly name="loan_amount"/></p>
                    <p><span>Status</span>
                        <select name="status">
                            <option name="APPROVED" <?php if($schol->status=="APPROVED"){echo 'selected';}?>>APPROVED</option>
                            <option name="ISSUED" <?php if($schol->status=="ISSUED"){echo 'selected';}?>>ISSUED</option>
                            <option name="COMPLETED" <?php if($schol->status=="COMPLETED"){echo 'selected';}?>>COMPLETED</option>
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