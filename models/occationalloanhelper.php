<?php
function getScholGrade5ForUser($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GRADE5' AND member_id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getScholGCEALForUser($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GCEAL' AND member_id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getFestivalAdvanceUser($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."festival_loan WHERE member_id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getScholGrade5()
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GRADE5'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getScholGCEAL()
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GCEAL'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getFestivalAdvances()
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."festival_loan";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getScholGrade5ByStatus($status)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GRADE5' status='".$status."'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getScholGCEALByStatus($status)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GCEAL' status='".$status."'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getFestivalAdvancesByStatus($status)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."festival_loan WHERE status='".$status."'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getScholGrade5ById($id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GRADE5' AND loan_id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}

function getScholGCEALbyId($id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_type='GCEAL' AND loan_id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}

function getFestivalAdvanceById($id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."festival_loan WHERE id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}

function updateFestivalAdvance($id,$status)
{
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."festival_loan
		SET
		status = ?
		WHERE
		id = ?");
    $stmt->bind_param("si", $status, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


?>