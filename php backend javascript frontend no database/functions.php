<?php
	$cookie_name = ['chr_staff_id', 'chr_lname', 'chr_fname', 'chr_mname', 'chr_age', 'chr_birthday', 'chr_address', 'chr_contact', 'chr_date_added', 'chr_status'];
	$cookie_value = ['1', 'Comia', 'Jon Angelo', 'Capuchino', '20', '1997-07-28', 'Mamatid Cabuyao Laguna', '0918 911 5942', '06/09/2018 01:52:45 am', '1'];

	for ($r=0; $r < count($cookie_name); $r++) { 
		if(!isset($_COOKIE[$cookie_name[$r]])) {
			setcookie($cookie_name[$r], $cookie_value[$r], time() + (86400 * 30), '/');
		}
	}
	
	include 'staff.php';
?>