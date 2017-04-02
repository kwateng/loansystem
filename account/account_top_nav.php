<?php
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF']))
?>
<div id="header">
    <div id="logo">
        <h1>Community Service Portal</h1>
    </div>
    <div id="sub-head" style="margin-left: 150px" class="subhead">
        <p>Co-operative  Thrift and Credit Society of State Engineering Corporation
            <?php
            if(isUserLoggedIn()){
                echo "<a style='font-family:verdana;font-size: 12px;' href = '../logout.php'>Logout</a>";
            } else {
                echo "<a style='font-family:verdana;font-size: 12px;' href = '../login.php'>Login</a>";
            }
            ?>
        </p>
    </div>
    <div id="menubar">
        <ul id="menu">
            <!-- put class="current" in the li tag for the selected page - to highlight which page you're on -->
            <?php
            echo "<li class='current' id='index'><a href='../index.php'>Home</a></li>";
            if(isUserLoggedIn()) {
                if (isEmployee($loggedInUser->user_id)) {
                    echo "<li id='generalloans'><a href='../generalloans.php'>General Loans</a></li>";
                }
                if (isEmployee($loggedInUser->user_id)) {
                    echo "<li id='occationalloans'><a href = '../occationalloans.php' > Occasional Loans </a ></li>";
                }
                if (isEmployee($loggedInUser->user_id)) {
                    if (isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
                        echo "<li id='register'><a href = '../register.php' > Register</a ></li>";
                    }
                }
                if (isEmployee($loggedInUser->user_id)) {
                    echo "<li id='lregisteroandetails'><a href = 'my_loan_details.php'>My Loans</a ></li>";
                }
                if (isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
                    echo "<li id=''><a href = '../register.php' > Register</a ></li>";
                }
                if (isAdmin($loggedInUser->user_id) || isManager($loggedInUser->user_id)) {
                    echo "<li id='viewloans'><a href = '../view_loans.php' > Loans</a ></li>";
                }
                if (isAccountant($loggedInUser->user_id)) {
                    echo "<li id='viewloans'><a href = 'view_loans_accountant.php' > Loans</a ></li>";
                }
                echo "<li id='myaccounnt'><a href = '../account/view_account.php' >Account</a ></li>";
            }
            echo "<li id='society-news'><a href='../society-news.php'>Society News</a></li>";
            echo "<li id='contact'><a href='../contact.php'>Contact Us</a></li>"
            ?>
        </ul>
    </div>
</div>