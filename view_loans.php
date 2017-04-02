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
            $( "#viewloans" ).addClass( "current" );
        </script>
        <div id="content">
            <!-- insert the page content here -->
            <h3>Select loan types to list places loans</h3>
            <ul id="verticalmenu" class="glossymenu">
                <li><a href="view_all_ordinary_loans.php">All ordinary loans</a></li>
                <li><a href="view_all_instant_loans.php" >All instant loans</a></li>
                <li><a href="view_all_distress_loans.php">All distress loans</a></li>
                <li><a href="view_all_festival_loans.php" >All festival advances</a></li>
                <li><a href="view_all_schol_loansl.php">All scholarship loans</a></li>
            </ul>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
