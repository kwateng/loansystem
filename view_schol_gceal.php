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
        $loan=getScholGCEALbyId($id);
    } else {
        $loan=getScholGCEALbyId($id);
        if(!$loan->member_id==$loggedInUser->user_id) {
            header("Location: unauthorize.php");
            die();
        }
    }
}
?>
<style>
    /* BUTTON */
    .linkb {
        -webkit-border-radius: 2px;
        -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
        -webkit-user-select: none;
        background: -webkit-linear-gradient(#fafafa, #f4f4f4 40%, #e5e5e5);
        border: 1px solid #aaa;
        color: #444;
        font-size: inherit;
        margin-bottom: 0px;
        min-width: 4em;
        padding: 3px 12px 3px 12px;
        font-family: sans-serif;
    }
</style>
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
            $( "#viewloans" ).addClass( "current" );
        </script>
        <div id="content">
            <h3>Scholarship Scheme GCEAL Loan Details: Member_ID-<a href="account/view_account.php?employee_id=<?=$loan->member_id?>"><?=$loan->member_id?></h3>
            <form method="post">
                <div class="form_settings">
                    <table width="600">
                        <tbody>
                        <tr>
                            <td>Loan ID</td>
                            <td><?=$loan->loan_id?></td>
                        </tr>
                        <tr>
                            <td>Member Id</td>
                            <td><?=$loan->member_id?></td>
                        </tr>
                        <tr>
                            <td>Dependent Name</td>
                            <td><?=$loan->dependent_name?></td>
                        </tr>
                        <tr>
                            <td>Examination No</td>
                            <td><?=$loan->examination_no?></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td><?=$loan->year?></td>
                        </tr>
                        <tr>
                            <td>School</td>
                            <td><?=$loan->school?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?=$loan->date_of_birth?></td>
                        </tr>
                        <tr>
                            <td>No of attempts</td>
                            <td><?=$loan->no_of_attempts?></td>
                        </tr>
                        <tr>
                            <td>Island Rank</td>
                            <td><?=$loan->rank?></td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td><?=$loan->amount?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?=$loan->status?></td>
                        </tr>

                        <tr>
                            <td>Placed Date</td>
                            <td><?=$loan->placed_date?></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php
                    if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)){
                        echo "<a href='edit_schol_gceal.php?loan_id=".$loan->loan_id."' class='linkb'>Edit loan</a>";
                    } else if(isAccountant($loggedInUser->user_id)) {
                        echo "<a href='edit_schol_gceal_accountant.php?loan_id=".$loan->loan_id."' class='linkb'>Edit loan</a>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>