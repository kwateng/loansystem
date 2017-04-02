<?php
function getOrdinaryLoansForUser($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='GENERAL' AND member_id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getDistressLoansForUser($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='DISTRESS' AND member_id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getInstantLoansForUser($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='INSTANT' AND member_id=".$user_id;
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getOrdinaryLoansByGurantor($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='GENERAL' AND (gurantor_id1=".$user_id." OR gurantor_id2=".$user_id.")";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getDistressLoansByGurantor($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='DISTRESS' AND (gurantor_id1=".$user_id." OR gurantor_id2=".$user_id.")";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getInstantLoansByGurantor($user_id)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='INSTANT' AND (gurantor_id1=".$user_id." OR gurantor_id2=".$user_id.")";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getAllOrdinaryLoans()
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='GENERAL';";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getDistressLoans()
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='DISTRESS'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getInstantLoans()
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='INSTANT'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}


function getAllOrdinaryLoansByStatus($status)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='GENERAL' AND status='".$status."'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
        print($row);
    }
    return $data_arr;
}

function getDistressLoansByStatus($status)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='DISTRESS' AND status='".$status."'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}

function getInstantLoansByStatus($status)
{
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='INSTANT' AND status='".$status."'";
    $result=mysqli_query($mysqli,$stmt);
    $data_arr= array();
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
        array_push($data_arr, $row);
    }
    return $data_arr;
}


function getOrdinaryLoanById($id) {
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='GENERAL' AND loan_id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}

function getDistressLoanById($id) {
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='DISTRESS' AND loan_id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}

function getInstantLoanById($id) {
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_type='INSTANT' AND loan_id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}

function updateLoan($id, $status) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."general_loans
		SET
		status = ?
		WHERE
		loan_id = ?");
    $stmt->bind_param("si", $status, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateLoanGurantor1Status($id, $status) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."general_loans
		SET
		gurantor1_status = ?
		WHERE
		loan_id = ?");
    $stmt->bind_param("si", $status, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateLoanGurantor2Status($id, $status) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."general_loans
		SET
		gurantor2_status = ?
		WHERE
		loan_id = ?");
    $stmt->bind_param("si", $status, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deleteLoan($id) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("DELETE FROM ".$db_table_prefix."general_loans
		WHERE loan_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    $stmt->close();
}

function getGeneralLoanById($id) {
    global $mysqli, $db_table_prefix;
    $stmt ="SELECT * FROM ".$db_table_prefix."general_loans WHERE loan_id=".$id;
    $result=mysqli_query($mysqli,$stmt);
    $row = mysqli_fetch_object($result);
    return $row;
}
?>