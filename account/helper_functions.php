<?php
function getAccountDetails($user_id){
    global $mysqli,$db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."users WHERE id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    if($row!=null){
        $user=new UserAccount();
        $user->member_id=$row->id;
        $user->employee_id=$row->employee_id;
        $user->username=$row->user_name;
        $user->displayname=$row->display_name;
        $user->clean_email=$row->email;
        $user->mobile_no=$row->mobile_no;
        $user->land_no=$row->land_no;
        $user->salary=$row->salary;
        $user->service=$row->service;
        $user->dsignation=$row->designation;
        $user->address=$row->address;
        $user->full_name=$row->full_name;
        $user->role=$row->role;
        return $user;
    }
    return null;
}

function updateMemberAccount($user) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."users SET user_name = ?,display_name = ?,
     email = ?,mobile_no = ?,land_no = ?,address = ?,full_name=? WHERE id = ? LIMIT 1");
    $stmt->bind_param("sssssssi", $user->username,$user->displayname,$user->clean_email,$user->mobile_no,$user->land_no,$user->address,$user->full_name, $user->member_id);
    $stmt->execute();
    $stmt->close();
}

function updateAdminOrManagerAccount($user) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."users SET user_name = ?,display_name = ?,
     email = ?,mobile_no = ?,land_no = ?,address = ?,full_name=?, role=?,designation=?,service=?, salary=? WHERE id = ? LIMIT 1");
    $stmt->bind_param("sssssssssidi", $user->username,$user->displayname,$user->clean_email,$user->mobile_no,$user->land_no,$user->address,$user->full_name,$user->role,$user->dsignation,$user->service,$user->salary, $user->member_id);
    $stmt->execute();
    $stmt->close();
}

function updatePassword($newpass,$user_id) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."users SET password = ? WHERE id = ? LIMIT 1");
    $secure_pass = generateHash($newpass);
    $stmt->bind_param("si",$secure_pass,$user_id);
    $stmt->execute();
    $stmt->close();
}
?>