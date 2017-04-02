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
            $( "#generalloans" ).addClass( "current" );
        </script>
        <div id="content">
            <!-- insert the page content here -->
            <h3 align="center">We are offering three types of general loans. Please find details below</h3>
            <div class="loanbox">
                <h3>Ordinary Loans</h3>
                <p>This type of loans can apply for any member with two guarantors. The maximum amount of the loan
                    will be decided on your salary where you needs to ensure that 40% of your salary remains after the monthly
                    installment payment(Maximum amount is 250000)</p>
                <input type="button" onclick="window.location='normalloan.php';" value="Apply" />
            </div>
            <div class="loanbox">
                <h3>Distress Loans</h3>
                <p>This type of loans can apply for any member with two guarantors.(Maximum amount is 50000)</p>
                <input type="button" onclick="window.location='distressloan.php';" value="Apply"/>
            </div>
            <div class="loanbox">
                <h3>Instant Loans</h3>
                <p>This type of loans can apply for any member with two guarantors. This loan will be issue at any
                emergency(Maximum is 5000)</p>
                <input type="button" onclick="window.location='instant.php';" value="Apply"/>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
