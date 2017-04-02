<?php
class GeneralLoan
{
    public $member_id;
    public $loan_id;
    public $duration;
    public $loan_type;
    public $sub_type;
    public $amount;
    public $gurantorid1;
    public $gurantorid1_status;
    public $gurantorid2;
    public $gurantorid2_status;
    public $completed;
    public $monthly_installment;
    public $start_date;
    public $placed_date;
    public $status;

function __construct($member_id,$duration,$amount,$gurantorid1,$gurantorid2,$monthly_installment) {
    $this->member_id=$member_id;
    $this->duration=$duration;
    $this->amount=$amount;
    $this->gurantorid1=$gurantorid1;
    $this->gurantorid2=$gurantorid2;
    $this->gurantorid1_status="PENDING";
    $this->gurantorid2_status="PENDING";
    $this->gurantorid2=$gurantorid2;
    $this->monthly_installement=$monthly_installment;
}

function addNewNormalLoan() {
   $this->loan_type="GENERAL";
   $this->sub_type="GENERAL";
   $this->completed=false;
   $this->placed_date=date('Y-m-d H:i:s');
   $this->status="PENDING";
}

function addNewDistressLoan($sub_type) {
    $this->loan_type="DISTRESS";
    $this->sub_type=$sub_type;
    $this->completed=false;
    $this->placed_date=date('Y-m-d H:i:s');
    $this->status="PENDING";
}

function addInstantLoan() {
    $this->loan_type="INSTANT";
    $this->sub_type="INSTANT";
    $this->completed=false;
    $this->placed_date=date('Y-m-d H:i:s');
    $this->status="PENDING";
}

function addGeneralLoan() {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."general_loans (
					member_id,
					duration,
					loan_type,
					sub_type,
					amount,
					gurantor_id1,
					gurantor1_status,
					gurantor_id2,
					gurantor2_status,
					status,
					completed,
					monthly_installment,
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
					?
					)");
    $stmt->bind_param("iissdisissids", $this->member_id, $this->duration, $this->loan_type, $this->sub_type, $this->amount,
        $this->gurantorid1,$this->gurantorid1_status,$this->gurantorid2,$this->gurantorid2_status,$this->status,intval($this->completed),$this->monthly_installement,$this->placed_date);
    $stmt->execute();
    echo $mysqli->error;
    $inserted_id = $mysqli->insert_id;
    $stmt->close();
    return $inserted_id;
}

function getLoanByTypeForUser($loan_type,$user_id) {
    global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;

}

function getLoanByTypeAndSubTypeForUser($loan_type,$sub_type,$user_id) {
    global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;

}

function getAllLoansForUser($user_id) {
    global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;

}

}
?>