<!DOCTYPE HTML>
<html>

<head>
    <title>Co-operative  Thrift and Credit Society of State Engineering Corporation</title>
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine&amp;v1" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<?php
include 'connect.php';
$employee_id=$_POST["employee_id"];
$full_name=$_POST["full_name"];
$username=$_POST["username"];
$address=$_POST["address"];
$dsignation=$_POST["designation"];
$password=$_POST["password"];
$salary=$_POST["salary"];
$role=$_POST["role"];
$mobile_no=$_POST["mobile_no"];
$land_no=$_POST["land_no"];
$e_mail=$_POST["e_mail"];

$sql = sprintf("INSERT INTO member ".
    "(employee_id,username,address,name,mobile_no,land_no,designation,e_mail,password,salary,role)".
    "VALUES('$employee_id','$username','$address','$full_name','$mobile_no','$land_no','$dsignation','$e_mail','$password','$salary','$role')");
$retval = mysqli_query( $con, $sql );
if(!$retval)
{
    die(mysqli_error($con));
}
$result = mysqli_query($con,"SELECT * FROM member
WHERE employee_id='$employee_id'");
while($row = mysqli_fetch_array($result)) {
    $employee_id=$row["employee_id"];
    $member_id=$row["member_id"];
    $full_name=$row["name"];
    $username=$row["username"];
    $address=$row["address"];
    $dsignation=$row["designation"];
    $salary=$row["salary"];
    $role=$row["role"];
    $mobile_no=$row["mobile_no"];
    $land_no=$row["land_no"];
    $e_mail=$row["e_mail"];
}
mysqli_close($con);
?>
<body>
<div id="main">
    <?php include 'top-navbar.php';?>
    <div id="site_content">
        <?php include 'sidebar.php';?>
        <div id="content">
            <!-- insert the page content here -->
            <h3 align="center">Registered member details</h3>
            <form action="member.php" method="post">
                <div class="form_settings">
                    <p><span>Member_Id</span><?php echo $member_id; ?></p>
                    <p><span>Employee_Id</span><?php echo $employee_id; ?></p>
                    <p><span>Full Name</span><?php echo $full_name; ?></p>
                    <p><span>Username</span><?php echo $username; ?></p>
                    <p><span>Address</span><?php echo $address; ?></p>
                    <p><span>Designation</span><?php echo $dsignation; ?></p>
                    <p><span>Salary</span><?php echo $salary; ?></p>
                    <p><span>Role</span><?php echo $role; ?></p>
                    <p><span>Mobile_No</span><?php echo $mobile_no; ?></p>
                    <p><span>Land_No</span><?php echo $land_no; ?></p>
                    <p><span>Email Address</span><?php echo $e_mail; ?></p>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php';?>
</div>
</body>
</html>
