CREATE TABLE 'shares' (
'member_id' INT NOT NULL,
'no_of_shares' INT,
'price_per_share' DOUBLE, PRIMARY KEY(member_id),
FOREIGN KEY (member_id) REFERENCES member(member_id) ON DELETE CASCADE );

CREATE TABLE IF NOT EXISTS 'member' (
  'member_id' int(11) NOT NULL,
  'employee_id' int(11) NOT NULL,
  'address' varchar(255) NOT NULL,
  'name' varchar(100) NOT NULL,
  'mobile_no' varchar(13) NOT NULL,
  'land_no' varchar(13) DEFAULT NULL,
  'designation' varchar(30) NOT NULL,
  'e_mail' varchar(50) NOT NULL,
  'password' varchar(10) NOT NULL,
   PRIMARY KEY(member_id),
  'salary' double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `occational_loans` (
  `member_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `loan_type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
   PRIMARY KEY(loan_id),
   FOREIGN KEY (member_id) REFERENCES member(member_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `general_loans` (
  `member_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `service` int(11),
  `loan_type` varchar(255) NOT NULL,
  `sub_type` varchar(255),
  `amount` double NOT NULL,
  `gurantor_id1` int(11) NOT NULL,
  `gurantor_id2` int(11) NOT NULL,
  `completed` boolean not null default 0,
   `monthly_installment` double NOT NULL,
   `start_date` DATE NOT NULL,
   PRIMARY KEY(loan_id),
   FOREIGN KEY (member_id) REFERENCES member(member_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `installment` (
  `loan_id` int(11) NOT NULL,
  `installment_no` int(11) NOT NULL,
  `payment` DOUBLE NOT NULL,
  `payment_date` DATE NOT NULL,
   PRIMARY KEY(loan_id),
   FOREIGN KEY (loan_id) REFERENCES general_loans(loan_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
