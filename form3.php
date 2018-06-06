<?php

//let's start our session, so we have access to stored data
	session_start();

//let's create the query
$insert_query = 'insert into subscriptions (
				name,
				email_address,
				membership_type
				terms_and_conditions,
				name_on_card,
				credit_card_number,
				credit_card_expiration_date
						) values (
				" . $_SESSION['name'] . ",
				" . $_SESSION['email_address'] . ",
				" . $_SESSION['membership_type'] . ",
				" . $_SESSION['terms_and_conditions'] . ",
				" . $_POST['name_on_card'] . ",
				" . $_POST['credit_card_number'] . ",
				" . $_POST['credit_card_expiration_date'] . "
						);

//let's run the query
mysql_query($insert_query);
?>