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
            <h3>Select loan category</h3>
            <ul id="verticalmenu" class="glossymenu">
                <li><a href="view_all_approved_loans.php">All approved loans</a></li>
                <li><a href="view_all_issued_loans.php" >All issued loans</a></li>
                <li><a href="view_all_completed_loans.php">All completed loans</a></li>
            </ul>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
