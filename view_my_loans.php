<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("models/generalloanshelper.php");
require_once("models/occationalloanhelper.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
if(!empty($_GET)){
    $id=$_GET["member_id"];
    if(isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
        $ordinaryloans=getOrdinaryLoansForUser($id);
        $distressloans=getDistressLoansForUser($id);
        $instantloans=getInstantLoansForUser($id);
        $scholgcealloans=getScholGCEALForUser($id);
        $scholdgrade5loans=getScholGrade5ForUser($id);
        $festivalloans=getFestivalAdvanceUser($id);
    } else {
            header("Location: unauthorize.php");
            die();
    }
} else {
        $id=$loggedInUser->user_id;
        $ordinaryloans=getOrdinaryLoansForUser($id);
        $distressloans=getDistressLoansForUser($id);
        $instantloans=getInstantLoansForUser($id);
        $scholgcealloans=getScholGCEALForUser($id);
        $scholdgrade5loans=getScholGrade5ForUser($id);
        $festivalloans=getFestivalAdvanceUser($id);
}

?>
<!DOCTYPE HTML>
<html>
<?php include 'models/header.php';?>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
<script src="js/jquery.dataTables.columnFilter.js"></script>

<script>
    $(document).ready(function() {
        $('#myloans').dataTable();
        //$('#myloans').dataTable().columnFilter();
        $('#myloans').dataTable().columnFilter({
                aoColumns: [ { type: "select", values: [ 'GENERAL', 'FESTIVAL', 'SCHOL']},{ type: "select", values: [ 'GENERAL', 'DISTRESS','INSTANT','INSTANT','GRADE5','GCEAL','CHRISTMAS', 'NEWYEAR']},null,null,

                    { type: "select", values: [ 'PENDING', 'ISSUED', 'APPROVED']},null]
            });
    } );
</script>
<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <div id="site_content">
        <script>
            $(".current").removeClass("current");
            $( "#generalloans" ).addClass( "current" );
            $( "#viewloans" ).addClass( "current" );
        </script>
        <div id="content" style="width: 900px">
           <h3>Member_ID-<a href="account/view_account.php?employee_id=<?=$id?>"><?=$id?></a></h3>
           <div id="data-content">
             <table id="myloans" class="display" cellspacing="0" width="100%">
                 <thead>
                 <th>Loand Id</th>
                 <th>Loan Type</th>
                 <th>Loan Subtype</th>
                 <th>Amount</th>
                 <th>Status</th>
                 <th>Placed Date</th>
                 </thead>
                 <tfoot>
                 <th>Loand Id</th>
                 <th>Loan Type</th>
                 <th>Loan Subtype</th>
                 <th>Amount</th>
                 <th>Status</th>
                 <th>Placed Date</th>
                 </tfoot>
                 <tbody>
                 <?php
                 foreach ($ordinaryloans as $olaon) {
                 echo '<tr>';
                 echo '<td>';
                 echo "<a href='view_ordinary_loan.php?loan_id=".$olaon['loan_id']."'>GENERAL-".$olaon['loan_id']."</a>";
                 echo '</td>';
                 echo '<td>';
                 echo $olaon['loan_type'];
                 echo '</td>';
                 echo '<td>';
                 echo $olaon['sub_type'];
                 echo '</td>';
                     echo '<td>';
                     echo $olaon['amount'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['status'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['placed_date'];
                     echo '</td>';
                 echo '</tr>';
                 }

                 foreach ($distressloans as $olaon) {
                     echo '<tr>';
                     echo '<td>';
                     echo "<a href='view_distress_loan.php?loan_id=".$olaon['loan_id']."'>GENERAL-".$olaon['loan_id']."</a>";
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['sub_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['amount'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['status'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['placed_date'];
                     echo '</td>';
                     echo '</tr>';
                 }

                 foreach ($instantloans as $olaon) {
                     echo '<tr>';
                     echo '<td>';
                     echo "<a href='view_instant_loan.php?loan_id=".$olaon['loan_id']."'>GENERAL-".$olaon['loan_id']."</a>";
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['sub_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['amount'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['status'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['placed_date'];
                     echo '</td>';
                     echo '</tr>';
                 }

                 foreach ($scholgcealloans as $olaon) {
                     echo '<tr>';
                     echo '<td>';
                     echo "<a href='view_schol_gceal.php?loan_id=".$olaon['loan_id']."'>SCHOL-".$olaon['loan_id']."</a>";
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['amount'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['status'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['placed_date'];
                     echo '</td>';
                     echo '</tr>';
                 }

                 foreach ($scholdgrade5loans as $olaon) {
                     echo '<tr>';
                     echo '<td>';
                     echo "<a href='view_schol_grade_five.php?loan_id=".$olaon['loan_id']."'>SCHOL-".$olaon['loan_id']."</a>";
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['amount'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['status'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['placed_date'];
                     echo '</td>';
                     echo '</tr>';
                 }

                 foreach ($festivalloans as $olaon) {
                     echo '<tr>';
                     echo '<td>';
                     echo "<a href='view_festival_loan.php?loan_id=".$olaon['id']."'>FESTIVAL-".$olaon['id']."</a>";
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['loan_type'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['amount'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['status'];
                     echo '</td>';
                     echo '<td>';
                     echo $olaon['placed_date'];
                     echo '</td>';
                     echo '</tr>';
                 }

                 ?>
                 </tbody>
             </table>
           </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>