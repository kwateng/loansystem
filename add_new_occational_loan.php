<?php
class SchoolarshipScheme{
public $id;
public $member_id;
public $loan_type;
public $dependent_name;
public $examination_no;
public $year;
public $school;
public $date_of_birth;
public $no_of_attempts;
public $marks;
public $amount;
public $completed;
public $status;
public $placed_date;
public $started_date;
public $rank;

function __construct($member_id,$dependent_name,$examination_no,$year,$school,$date_of_birth,$amount){
    $this->member_id=$member_id;
    $this->dependent_name=$dependent_name;
    $this->examination_no=$examination_no;
    $this->year=$year;
    $this->school=$school;
    $this->date_of_birth=$date_of_birth;
    $this->amount=$amount;
}

function addGCEScholarshipScheme($no_of_attempts,$rank) {
    $this->no_of_attempts=$no_of_attempts;
    $this->loan_type="GCEAL";
    $this->status="PENDING";
    $this->completed=false;
    $this->marks=0;
    $this->placed_date=date('Y-m-d H:i:s');
    $this->rank=$rank;
}

function addGrade5ScholarshipScheme($marks) {
    $this->marks=$marks;
    $this->loan_type="GRADE5";
    $this->status="PENDING";
    $this->completed=false;
    $this->no_of_attempts=1;
    $this->placed_date=date('Y-m-d H:i:s');
}

function addOccasionalLoan() {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."occational_loans (
					member_id,
					loan_type,
					dependent_name,
					examination_no,
					year,
					school,
					date_of_birth,
					no_of_attempts,
					rank,
					marks,
					amount,
					completed,
					status,
					placed_date
					)
					VALUES (
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?
					)");
    $stmt->bind_param("issssssiiidiss", $this->member_id, $this->loan_type, $this->dependent_name, $this->examination_no,
        $this->year,$this->school,$this->date_of_birth,$this->no_of_attempts,$this->rank,$this->marks,$this->amount,intval($this->completed),$this->status,$this->placed_date);
    $stmt->execute();
    echo $mysqli->error;
    $inserted_id = $mysqli->insert_id;
    $stmt->close();
    return $inserted_id;
}

function getLoanById($id) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT* FROM ".$db_table_prefix."occational_loans (id) VALUES(?)");
    $stmt->bind_param("i",$id);
    $row = mysqli_fetch_object($stmt);
    if($row!=null){
    $occational_loan=new SchoolarshipScheme($row->member_id,$row->dependent_name,$row->examination_no,$row->year,$row->school,$row->date_of_birth,$row->amount);
    $occational_loan->status=$row->status;
    $occational_loan->id=$row->loan_id;
    $occational_loan->no_of_attempts=$row->no_of_attempts;
    $occational_loan->marks=$row->marks;
    $occational_loan->completed=$row->completed;
    $occational_loan->started_date=$row->started_date;
    $occational_loan->placed_date=$row->placed_date;
    return $occational_loan;
    }
    return null;
}
}
?>