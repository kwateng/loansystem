<?php
function getOccationalLoanById($loan_id) {
global $mysqli,$db_table_prefix;
$stmt ="SELECT * FROM ".$db_table_prefix."occational_loans WHERE loan_id=".$loan_id;
$result=mysqli_query($mysqli,$stmt);
$row = mysqli_fetch_object($result);
if($row!=null){
$occational_loan=new SchoolarshipScheme($row->member_id,$row->dependent_name,$row->examination_no,$row->year,$row->school,$row->date_of_birth,$row->amount);
$occational_loan->status=$row->status;
$occational_loan->id=$row->loan_id;
$occational_loan->loan_type=$row->loan_type;
$occational_loan->no_of_attempts=$row->no_of_attempts;
$occational_loan->marks=$row->marks;
$occational_loan->completed=$row->completed;
$occational_loan->started_date=$row->started_date;
$occational_loan->placed_date=$row->placed_date;
$occational_loan->rank=$row->rank;
return $occational_loan;
}
return null;
}

function updateOccationalLoanStatus($loan_id,$status) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."occational_loans SET status = ? WHERE loan_id = ? LIMIT 1");
    $stmt->bind_param("si", $status, $loan_id);
    $stmt->execute();
    $stmt->close();
}

?>