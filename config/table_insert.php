<?php
	 require('./config.php');
    require('./db.php');

	$table = "INSERT INTO `greencash_bank` (`username`, `number`, `email`, `acc_name`, `acc_number`, `acc_bank`, `amount`, `merge`, `merge_at`, `security`, `answer`, `pay_acc_name`, `pay_acc_number`, `pay_bank_name`, `image`, `ref_number`, `ref_by`) VALUES ('NewPerson', '012345678912', 'newperson@gmail.com', 'New person Name', '01234566789', 'New Bank', '10,000', '0', CURRENT_TIME, 'What is your favourite colour?', 'cybergate', 'pay New person', '2222230009', 'new person bank', 'newscreenshot.jpg', 'Ac84847', 'cybergate')";


	 if(mysqli_query($conn, $table) === false){
            echo "data not inserted : CONTACT ADMIN";
        }


?>