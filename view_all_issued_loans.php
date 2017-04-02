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
            <h3>All issued loan types</h3>
            <ul id="verticalmenu" class="glossymenu">
                <li><a href="view_all_ordinary_loans_accountant.php?status=issued">All ordinary loans</a></li>
                <li><a href="view_all_instant_loans_accountant.php?status=issued" >All instant loans</a></li>
                <li><a href="view_all_distress_loans_accountant.php?status=issued">All distress loans</a></li>
                <li><a href="view_all_festival_loans_accountant.php?status=issued" >All festival advances</a></li>
                <li><a href="view_all_schol_loans_accountant.php?status=issued">All scholarship loans</a></li>
            </ul>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
