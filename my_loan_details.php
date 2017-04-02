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
            <h3>My Loan Options</h3>
            <ul id="verticalmenu" class="glossymenu">
                <li><a href="requests_gurantee.php">All ordinary loans</a></li>
                <li><a href="view_my_loans.php" >Guarantor requests</a></li>
            </ul>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
