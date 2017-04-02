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
        header("Location: view_schol_grade_five.php?loan_id=".$id);
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
            <h3>Scholarship GRADE 5 Loan Details: Member ID- <a href="account/view_account.php?employee_id=<?=$loan->member_id?>"><?=$loan->member_id?></a></h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Loan Id</span><input class="contact" type="text" name="loan_id" value="<?=$schol->id?>" readonly/></p>
                    <p><span>Member Id</span><input class="contact" type="text" name="member_id" value="<?=$schol->member_id?>" readonly/></p>
                    <p><span>Child Name</span><input class="contact" type="text" name="child_name" value="<?=$schol->dependent_name?>" readonly/></p>
                    <p><span>School/Institute</span><input class="contact" type="text" name="school_institute" value="<?=$schol->school?>" readonly/></p>
                    <p><span>Date of Birth</span><input class="contact" type="text" name="date_of_birth" value="<?=$schol->date_of_birth?>" readonly/></p>
                    <p><span>Exam Index Number</span><input class="contact" type="text" name="exam_index" value="<?=$schol->examination_no?>" readonly/></p>
                    <p><span>Exam Attempt Year</span><input class="contact" type="text" name="attempt_year" value="<?=$schol->year?>" readonly/></p>
                    <p><span>Marks</span><input class="contact" type="text" name="marks" value="<?=$schol->marks?>" readonly/></p>
                    <p><span>Loan Amount</span><input class="contact" type="text" name="loan_amount" value="<?=$schol->amount?>" readonly/></p>
                    <p><span>Status</span>
                        <select name="status">
                            <option name="APPROVED" <?php if($schol->status=="APPROVED"){echo 'selected';}?>>APPROVED</option>
                            <option name="ISSUED" <?php if($schol->status=="ISSUED"){echo 'selected';}?>>ISSUED</option>
                            <option name="COMPLETED" <?php if($schol->status=="COMPLETED"){echo 'selected';}?>>COMPLETED</option>
                            <option name="PENDING" <?php if($schol->status=="PENDING"){echo 'selected';}?>>PENDING</option>
                            <option name="PENDING" <?php if($schol->status=="CANCELLED"){echo 'selected';}?>>CANCELLED</option>
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