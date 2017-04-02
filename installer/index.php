<?php
require_once("../models/db-settings.php");
require_once("../models/funcs.php");
?>

    <head>
        <title>Co-operative  Thrift and Credit Society of State Engineering Corporation</title>
        <meta name="description" content="website description" />
        <meta name="keywords" content="website keywords, website keywords" />
        <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine&amp;v1" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
        <link rel="stylesheet" type="text/css" href="../style/style.css" />
    </head>
    <body>
    <div id='top'><div id='logo'></div></div>
    <div id='content'>
        <h1>Loan System</h1>
        <h2>Installer</h2>;

<?php
if(isset($_GET["install"]))
{
    $db_issue = false;

    $permissions_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."permissions` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(150) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
	";

    $permissions_entry = "
	INSERT INTO `".$db_table_prefix."permissions` (`id`, `name`) VALUES
	(1, 'Admin'),
	(2, 'Accontant'),
	(3, 'Manager'),
	(4, 'Member');
	";

    $users_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(50) NOT NULL,
	`display_name` varchar(50) NOT NULL,
	`password` varchar(225) NOT NULL,
	`email` varchar(150) NOT NULL,
	`activation_token` varchar(225) NOT NULL,
	`last_activation_request` int(11) NOT NULL,
	`lost_password_request` tinyint(1) NOT NULL,
	`active` tinyint(1) NOT NULL,
	`title` varchar(150) NOT NULL,
	`sign_up_stamp` int(11) NOT NULL,
	salary double NOT NULL,
	mobile_no varchar(13) NOT NULL,
	land_no varchar(13) DEFAULT NULL,
	employee_id int(11) NOT NULL,
	service int(11) NOT NULL,
	address varchar(255) NOT NULL,
	designation varchar(30) NOT NULL,
	full_name varchar(255) NOT NULL,
	role varchar(20) NOT NULL,
	`last_sign_in_stamp` int(11) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

    $admin_pass_hash=generateHash("admin");

    $admin_user= "
	INSERT INTO `".$db_table_prefix."users` (`user_name`, `display_name`, `password`, `email`
	, `activation_token`, `last_activation_request`, `lost_password_request`, `active`, `title`, `sign_up_stamp`
	, `salary`, `mobile_no`,`land_no`,`employee_id`, `service`, `designation`, `address`, `full_name`,`role`,`last_sign_in_stamp`) VALUES
	('admin', 'Admin','".$admin_pass_hash."','loanadmin@gmail.com','admin token','1388701323',0,1,'admin','1388701323',
	0,'123456','123456',0,4,'admin','test','ADMIN','Admin','1388701323');
	";

    $user_permission_matches_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."user_permission_matches` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`permission_id` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (user_id) REFERENCES ".$db_table_prefix."users(id) ON DELETE CASCADE
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
	";

    $user_permission_matches_entry = "
	INSERT INTO `".$db_table_prefix."user_permission_matches` (`id`, `user_id`, `permission_id`) VALUES
	(1, 1, 1);
	";

    $configuration_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."configuration` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(150) NOT NULL,
	`value` varchar(150) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
	";

    $festival_sql = "
	CREATE TABLE IF NOT EXISTS `".$db_table_prefix."festival_loan` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`member_id` int(11) NOT NULL,
	`loan_type` varchar(150) NOT NULL,
	`status` varchar(25) NOT NULL,
	`placed_date` DATE NOT NULL,
	`approved_date` DATE,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
	";

    $configuration_entry = "
	INSERT INTO `".$db_table_prefix."configuration` (`id`, `name`, `value`) VALUES
	(1, 'website_name', 'Loan System'),
	(2, 'website_url', 'localhost/'),
	(3, 'email', 'thilinianorathna@gmail.com'),
	(4, 'activation', 'false'),
	(5, 'resend_activation_threshold', '0'),
	(6, 'language', 'models/languages/en.php'),
	(7, 'template', 'models/site-templates/default.css');
	";

    $pages_sql = "CREATE TABLE IF NOT EXISTS `".$db_table_prefix."pages` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`page` varchar(150) NOT NULL,
	`private` tinyint(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;
	";

    $pages_entry = "INSERT INTO `".$db_table_prefix."pages` (`id`, `page`, `private`) VALUES
	(1, 'myaccount.php', 1),
	(2, 'activate-myaccount.php', 0),
	(3, 'admin_configuration.php', 1),
	(4, 'admin_page.php', 1),
	(5, 'admin_pages.php', 1),
	(6, 'admin_permission.php', 1),
	(7, 'admin_permissions.php', 1),
	(8, 'admin_user.php', 1),
	(9, 'admin_users.php', 1),
	(10, 'forgot-password.php', 0),
	(11, 'index.php', 0),
	(12, 'left-nav.php', 0),
	(13, 'login.php', 0),
	(14, 'logout.php', 1),
	(15, 'register.php', 0),
	(16, 'resend-activation.php', 0),
	(17, 'user_settings.php', 1);
	";

    $permission_page_matches_sql = "CREATE TABLE IF NOT EXISTS `".$db_table_prefix."permission_page_matches` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`permission_id` int(11) NOT NULL,
	`page_id` int(11) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;
	";

    $permission_page_matches_entry = "INSERT INTO `".$db_table_prefix."permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
	(1, 1, 1),
	(2, 1, 14),
	(3, 1, 17),
	(4, 2, 1),
	(5, 2, 3),
	(6, 2, 4),
	(7, 2, 5),
	(8, 2, 6),
	(9, 2, 7),
	(10, 2, 8),
	(11, 2, 9),
	(12, 2, 14),
	(13, 2, 17);
	";

    $occational_loan_table="CREATE TABLE IF NOT EXISTS `".$db_table_prefix."occational_loans` (
     `member_id` int(11) NOT NULL,
     `loan_id` int(11) NOT NULL AUTO_INCREMENT,
     `loan_type` varchar(255) NOT NULL,
     `dependent_name` varchar(105) NOT NULL,
     `examination_no` varchar(15) NOT NULL,
     `year` varchar(5) NOT NULL,
     `school` varchar(255) NOT NULL,
     `date_of_birth` varchar(25) NOT NULL,
     `no_of_attempts` INT,
     `rank` INT,
     `marks` INT,
     `amount` double NOT NULL,
     `completed` boolean not null default 0,
     `status` varchar(25) NOT NULL,
     `started_date` DATE,
     `placed_date` DATE NOT NULL,
      PRIMARY KEY(loan_id),
      FOREIGN KEY (member_id) REFERENCES ".$db_table_prefix."users(id) ON DELETE CASCADE
     ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $general_loan_table="CREATE TABLE IF NOT EXISTS `".$db_table_prefix."general_loans` (
     `member_id` int(11) NOT NULL,
     `loan_id` int(11) NOT NULL AUTO_INCREMENT,
     `duration` int(11) NOT NULL,
     `loan_type` varchar(255) NOT NULL,
     `sub_type` varchar(255),
     `amount` double NOT NULL,
     `gurantor_id1` int(11) NOT NULL,
     `gurantor1_status` varchar(50) NOT NULL,
     `gurantor_id2` int(11) NOT NULL,
     `gurantor2_status` varchar(50) NOT NULL,
     `status` varchar(50) NOT NULL,
     `completed` boolean not null default 0,
     `monthly_installment` double NOT NULL,
     `start_date` DATE,
     `placed_date` DATE NOT NULL,
     PRIMARY KEY(loan_id),
     FOREIGN KEY (member_id) REFERENCES ".$db_table_prefix."users(id) ON DELETE CASCADE
     ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $installment_table="CREATE TABLE IF NOT EXISTS `".$db_table_prefix."installment` (
     `loan_id` int(11) NOT NULL,
     `installment_no` int(11) NOT NULL,
     `payment` DOUBLE NOT NULL,
     `payment_date` DATE NOT NULL,
     `status` varchar(50) NOT NULL,
     `completed` boolean not null default 0,
      PRIMARY KEY(loan_id),
      FOREIGN KEY (loan_id) REFERENCES ".$db_table_prefix."general_loans(loan_id) ON DELETE CASCADE
     ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    $share_table="CREATE TABLE IF NOT EXISTS `".$db_table_prefix."shares` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     member_id INT NOT NULL,
     no_of_share INT,
     price_per_share DOUBLE,
     PRIMARY KEY(id),
     FOREIGN KEY (member_id) REFERENCES ".$db_table_prefix."users(id) ON DELETE CASCADE );";

    $comments_table="CREATE TABLE IF NOT EXISTS `".$db_table_prefix."comments` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     user_id INT NOT NULL,
     loan_id INT NOT NULL,
     `comment` varchar(255) NOT NULL,
     `type` varchar(50) NOT NULL,
     PRIMARY KEY(id)
     );";

    $stmt = $mysqli->prepare($users_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."users table created.....</p>";

        $stmt = $mysqli->prepare($admin_user);
        if($stmt->execute())
        {
            echo "<p>".$db_table_prefix."general admin user created.....</p>";
        }
        else
        {
            echo "<p>Error while creating admin user.</p>";
            $db_issue = true;
        }
    }
    else
    {
        echo "<p>Error constructing users table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($configuration_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."configuration table created.....</p>";
        $stmt = $mysqli->prepare($configuration_entry);
        if($stmt->execute())
        {
            echo "<p>Inserted basic config settings into ".$db_table_prefix."configuration table.....</p>";
        }
        else
        {
            echo "<p>Error inserting config settings access.</p>";
            $db_issue = true;
        }
    }
    else
    {
        echo "<p>Error constructing ".$db_table_prefix."configuration table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($permissions_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."permissions table created.....</p>";
        $stmt = $mysqli->prepare($permissions_entry);
        if($stmt->execute())
        {
            echo "<p>Inserted 'New Member' and 'Admin' groups into ".$db_table_prefix."permissions table.....</p>";
        }
        else
        {
            echo "<p>Error inserting permissions.</p>";
            $db_issue = true;
        }
    }
    else
    {
        echo "<p>Error constructing ".$db_table_prefix."permissions table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($user_permission_matches_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."user_permission_matches table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing ".$db_table_prefix."user_permission_matches table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($user_permission_matches_entry);
    if($stmt->execute())
    {
        echo "<p>Added 'Admin' entry for first user in ".$db_table_prefix."user_permission_matches table.....</p>";
    }
    else
    {
        echo "<p>Error inserting admin into ".$db_table_prefix."user_permission_matches.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($pages_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."pages table created.....</p>";
        $stmt = $mysqli->prepare($pages_entry);
        if($stmt->execute())
        {
            echo "<p>Added default pages to ".$db_table_prefix."pages table.....</p>";
        }
        else
        {
            echo "<p>Error inserting pages into ".$db_table_prefix."pages.</p>";
            $db_issue = true;
        }
    }
    else {
        echo "<p>Error constructing " . $db_table_prefix . "pages table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($permission_page_matches_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."permission_page_matches table created.....</p>";
        $stmt = $mysqli->prepare($permission_page_matches_entry);
        if($stmt->execute())
        {
            echo "<p>Added default access to ".$db_table_prefix."permission_page_matches table.....</p>";
        }
        else
        {
            echo "<p>Error adding default access to ".$db_table_prefix."user_permission_matches.</p>";
            $db_issue = true;
        }
    }
    else
    {
        echo "<p>Error constructing ".$db_table_prefix."permission_page_matches table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($occational_loan_table);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."occational_loans table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing occational loan table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($general_loan_table);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."general_loans table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing general loan table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($installment_table);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."installment table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing installment table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($share_table);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."_shares table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing share table.</p>";
        $db_issue = true;
    }

    $stmt = $mysqli->prepare($comments_table);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."comments table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing comments table.</p>";
        $db_issue = true;
    }
    $stmt = $mysqli->prepare($festival_sql);
    if($stmt->execute())
    {
        echo "<p>".$db_table_prefix."festival table created.....</p>";
    }
    else
    {
        echo "<p>Error constructing festival table.</p>";
        $db_issue = true;
    }
    if(!$db_issue)
        echo "<p><strong>Database setup complete, please delete the install folder.</strong></p>";
    else
        echo "<p><a href=\"?install=true\">Try again</a></p>";
}
else
{
    echo "
	<a href='?install=true'>Install Loan System</a>
	";
}

echo "
</body>
</html>";

?>