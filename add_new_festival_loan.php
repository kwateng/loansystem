<?php
class FestivalLaon
{
    public $member_id;
    public $loan_type;
    public $approved_date;
    public $placed_date;
    public $status;

    function __construct($member_id,$loan_type) {
        $this->member_id=$member_id;
        $this->loan_type=$loan_type;
        $this->placed_date=date('Y-m-d H:i:s');
        $this->status="PENDING";
    }

    function addFestivalLoan() {
        global $mysqli,$db_table_prefix;
        $stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."festival_loan (
					member_id,
					loan_type,
					status,
					placed_date
					)
					VALUES (
					?,
					?,
					?,
					?
					)");
        $stmt->bind_param("isss", $this->member_id, $this->loan_type, $this->status, $this->placed_date);
        $stmt->execute();
        $inserted_id = $mysqli->insert_id;
        $stmt->close();
        return $inserted_id;
    }
}
?>