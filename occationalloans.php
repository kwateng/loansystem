<!DOCTYPE HTML>
<html>
<?php include 'models/header.php';?>
<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <script>
        $(".current").removeClass("current");
        $( "#occationalloans" ).addClass( "current" );
    </script>
    <div id="site_content">
        <?php include 'sidebar.php';?>
        <div id="content">
            <!-- insert the page content here -->
            <h3 align="center">We are offering three types of occasional loans. Please find details below</h3>
            <div class="loanbox">
                <h3 align="cenls
                cter">Scholarship Scheme</h3>
                <p align="justify">Employees children are awarded with scholarships for their performance at national
                    level examinatiodeosns conducted by the Department of Examinations of the Ministry of Education. </p>
                <p align="justify">  1. Grade 5 Scholarship Examination - Scholarship of Rs.7500.<br />
                    2. GCE Advanced Level Examination - Scholarship of Rs.10000.<br />
                </p>
                <p>Apply for Grade 5 Scholarship Examination scheme :<input type="button" onclick="window.location='schlarshipex.php';" value="Apply"/></p>
                <p>Apply for GCE Advanced Level Examination scheme  :<input type="button" onclick="window.location='gcealscholar.php';" value="Apply"/></p>
            </div>
            <div class="loanbox">
                <h3>Festival Advance</h3>
                <p>Employees are facilitated with a festival advance of Rs.10000 which can be claimed once per year.
                    The amount should be paid within 10 months in period</p>
                <p>Apply for new year festival advance  :<input type="button" onclick="window.location='newyearfestival.php';" value="Apply"/></p>
                <p>Apply for christmas festival advance :<input type="button" onclick="window.location='christmasfestival.php';" value="Apply"/></p>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
