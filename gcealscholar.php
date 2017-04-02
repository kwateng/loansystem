<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("add_new_occational_loan.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

//Forms posted
if(!empty($_POST))
{
    $errors = array();
    $child_name = trim($_POST["child_name"]);
    $school_institute = trim($_POST["school_institute"]);
    $date_of_birth = trim($_POST["date_of_birth"]);
    $exam_index = trim($_POST["exam_index"]);
    $island_rank = trim($_POST["island_rank"]);
    $attempt_year = trim($_POST["attempt_year"]);
    $no_attempta = trim($_POST["no_attempta"]);
    $rank = trim($_POST["island_rank"]);
    $loan_amount = $LOAN_OCCASIONAL_GCEAL_AMOUNT;

    if(count($errors)==0) {
        $schol=new SchoolarshipScheme($loggedInUser->user_id,$child_name,$exam_index,$attempt_year,$school_institute,$date_of_birth,$loan_amount);
        $schol->addGCEScholarshipScheme($no_attempta,$rank);
        $loan_id=$schol->addOccasionalLoan();
        if($loan_id==null)
        {
            $errors[] = "Fail to add loan";
        } else {
            header("Location: view_schol_gceal.php?loan_id=".$loan_id);
        }
    }
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
            $( "#occationalloans" ).addClass( "current" );
        </script>
        <div id="content">
            <h3>GCE Advanced Level Examination scheme - Child Details</h3>
            <form method="post">
                <div class="form_settings">
                    <p><span>Full Name</span><input class="contact" type="text" name="child_name"/></p>
                    <p><span>School/Institute</span><input class="contact" type="text" name="school_institute"/></p>
                    <p><span>Date of Birth</span><input class="contact" type="text" name="date_of_birth"/></p>
                    <p><span>Exam Index Number</span><input class="contact" type="text" name="exam_index"/></p>
                    <p><span>Island Rank</span><input class="contact" type="text" name="island_rank"/></p>
                    <p><span>Exam Attempt Year</span><input class="contact" type="text" name="attempt_year"/></p>
                    <p><span>No of Attempts</span><input class="contact" type="text" name="no_attempta"/></p>
                    <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" value="submit" /></p>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>