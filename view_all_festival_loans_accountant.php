<?php
require_once("models/config.php");
require_once("models/constants.php");
require_once("models/generalloanshelper.php");
require_once("models/occationalloanhelper.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
if(!empty($_GET)) {
    $status = $_GET["status"];
    if($status!="completed" && $status!="issued" && $status!="approved"){
        header("Location: unauthorize.php");
        die();
    }
    if (isAccountant($loggedInUser->user_id)) {
        $festivalloans = getFestivalAdvancesByStatus($status);
    } else {
        header("Location: unauthorize.php");
        die();
    }
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
        $('#myloans').dataTable().columnFilter({
            aoColumns: [ "","",null,null,null,null,null]
        });
    } );
</script>
<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <div id="site_content">
        <script>
            $(".current").removeClass("current");
            $( "#viewloans" ).addClass( "current" );
        </script>
        <div id="content" style="width: 900px">
            <div id="data-content">
                <table id="myloans" class="display" cellspacing="0" width="100%">
                    <thead>
                    <th>Loand Id</th>
                    <th>Member Id</th>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Placed Date</th>
                    </thead>
                    <tfoot>
                    <th>Loand Id</th>
                    <th>Member Id</th>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Placed Date</th>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach ($festivalloans as $olaon) {
                        echo '<tr>';
                        echo '<td>';
                        echo "<a href='view_festival_loan.php?loan_id=".$olaon['id']."'>FESTIVAL-".$olaon['id']."</a>";
                        echo '</td>';
                        echo '<td>';
                        echo "<a href='account/view_account.php?employee_id=".$olaon['member_id']."'>".$olaon['member_id']."</a>";
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