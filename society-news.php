<!DOCTYPE HTML>
<html>
<?php include 'models/header.php';?>
<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <script>
        $(".current").removeClass("current");
        $( "#society-news" ).addClass( "current" );
    </script>
    <div id="site_content">
        <?php include 'sidebar.php';?>
        <div id="content">
            <!-- insert the page content here -->
            <h1>News</h1>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>