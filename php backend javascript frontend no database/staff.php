<?php

class Staff {
	private $db, $staff_id, $lname, $fname, $mname, $age, $birthday, $address, $contact, $date_added, $status;

	public function get_staff_credential($type) {
		$staff_credential;
		switch($type) {
			case "staff_id";
				$staff_credential = [$type => $this->staff_id];
			break;
			case "lname";
				$staff_credential = [$type => $this->lname];
			break;
			case "fname";
				$staff_credential = [$type => $this->fname];
			break;
			case "mname";
				$staff_credential = [$type => $this->mname];
			break;
			case "age";
				$staff_credential = [$type => $this->age];
			break;
			case "birthday";
				$staff_credential = [$type => $this->birthday];
			break;
			case "address";
				$staff_credential = [$type => $this->address];
			break;
			case "contact";
				$staff_credential = [$type => $this->contact];
			break;
			case "date_added";
				$staff_credential = [$type => $this->date_added];
			break;
			case "status";
				$staff_credential = [$type => $this->status];
			break;
			case "all";
				$staff_credential = ["staff_id" => $this->staff_id, "lname" => $this->lname, "fname" => $this->fname, "mname" => $this->mname, "age" => $this->age, "birthday" => $this->birthday, "address" => $this->address, "contact" => $this->contact, "date_added" => $this->date_added, "status" => $this->status];
			break;
			default:
				$staff_credential = null;
		}
		return $staff_credential;
	}
	public function set_staff_credential($type,$value) {
		switch($type) {
			case "staff_id";
				$this->staff_id = $value;
			break;
			case "lname";
				$this->lname = $value;
			break;
			case "fname";
				$this->fname = $value;
			break;
			case "mname";
				$this->mname = $value;
			break;
			case "age";
				$this->age = $value;
			break;
			case "birthday";
				$this->birthday = $value;
			break;
			case "address";
				$this->address = $value;
			break;
			case "contact";
				$this->contact = $value;
			break;
			case "date_added";
				$this->date_added = $value;
			break;
			case "status";
				$this->status = $value;
			break;
			case "all";
				$this->staff_id = $value["staff_id"];
				$this->lname = $value["lname"];
				$this->fname = $value["fname"];
				$this->mname = $value["mname"];
				$this->age = $value["age"];
				$this->birthday = $value["birthday"];
				$this->address = $value["address"];
				$this->contact = $value["contact"];
				$this->date_added = $value["date_added"];
				$this->status = $value["status"];
			break;
		}
	}
	public function startcreatestaff() {
		$status = true;
		if ($this->lname == null) $status = false;
		else if ($this->fname == null) $status = false;
		else if ($this->mname == null) $status = false;
		else $this->createstaff();
		return $status;
	}
	public function startreadstaff() {
		$this->staff_id = [];
		$this->lname = [];
		$this->fname = [];
		$this->mname = [];
		$this->age = [];
		$this->birthday = [];
		$this->address = [];
		$this->contact = [];
		$this->date_added = [];
		$this->status = [];
		$this->readstaff();
	}
	public function startfindstaff($like) {
		$this->staff_id = [];
		$this->lname = [];
		$this->fname = [];
		$this->mname = [];
		$this->age = [];
		$this->birthday = [];
		$this->address = [];
		$this->contact = [];
		$this->date_added = [];
		$this->status = [];
		$this->findstaff($like);
	}
	public function startupdatestaff() {
		$status = true;
		if ($this->staff_id == null) $status = false;
		else if ($this->lname == null) $status = false;
		else if ($this->fname == null) $status = false;
		else if ($this->mname == null) $status = false;
		else $this->updatestaff();
		return $status;
	}
	public function __construct() {
		$cookie_name = ['chr_staff_id', 'chr_lname', 'chr_fname', 'chr_mname', 'chr_age', 'chr_birthday', 'chr_address', 'chr_contact', 'chr_date_added', 'chr_status'];
		$cookie_value = ['1', 'Comia', 'Jon Angelo', 'Capuchino', '20', '1997-07-28', 'Mamatid Cabuyao Laguna', '0918 911 5942', '06/09/2018 01:52:45 am', '1'];

		for ($r=0; $r < count($cookie_name); $r++) { 
			if(!isset($_COOKIE[$cookie_name[$r]])) {
				setcookie($cookie_name[$r], $cookie_value[$r], time() + (86400 * 30), '/');
			}
		}
	}

	protected function createstaff() {
		$cookie_name = ['chr_staff_id', 'chr_lname', 'chr_fname', 'chr_mname', 'chr_age', 'chr_birthday', 'chr_address', 'chr_contact', 'chr_date_added', 'chr_status'];
		$cookie_nvalue = [ count( explode( '~chr~', $_COOKIE["chr_staff_id"] ) ) + 1, $this->lname, $this->fname, $this->mname, $this->age, $this->birthday, $this->address, $this->contact, $this->date_added, '1'];

		for ($r=0; $r < count($cookie_name); $r++) { 
			setcookie($cookie_name[$r], $_COOKIE[$cookie_name[$r]] . "~chr~" . $cookie_nvalue[$r], time() + (86400 * 30), '/');
		}
	}
	protected function readstaff() {
		if(!isset($_COOKIE["chr_staff_id"])) {
			header("Refresh:0");
		} else {
			$this->staff_id = explode( '~chr~', $_COOKIE["chr_staff_id"] );
			$this->lname = explode( '~chr~', $_COOKIE["chr_lname"] );
			$this->fname = explode( '~chr~', $_COOKIE["chr_fname"] );
			$this->mname = explode( '~chr~', $_COOKIE["chr_mname"] );
			$this->age = explode( '~chr~', $_COOKIE["chr_age"] );
			$this->birthday = explode( '~chr~', $_COOKIE["chr_birthday"] );
			$this->address = explode( '~chr~', $_COOKIE["chr_address"] );
			$this->contact = explode( '~chr~', $_COOKIE["chr_contact"] );
			$this->date_added = explode( '~chr~', $_COOKIE["chr_date_added"] );
			$this->status = explode( '~chr~', $_COOKIE["chr_status"] );
		}

	}
	protected function findstaff($like) {
		$r_staff_id = explode( '~chr~', $_COOKIE["chr_staff_id"] );
		$r_lname = explode( '~chr~', $_COOKIE["chr_lname"] );
		$r_fname = explode( '~chr~', $_COOKIE["chr_fname"] );
		$r_mname = explode( '~chr~', $_COOKIE["chr_mname"] );
		$r_age = explode( '~chr~', $_COOKIE["chr_age"] );
		$r_birthday = explode( '~chr~', $_COOKIE["chr_birthday"] );
		$r_address = explode( '~chr~', $_COOKIE["chr_address"] );
		$r_contact = explode( '~chr~', $_COOKIE["chr_contact"] );
		$r_date_added = explode( '~chr~', $_COOKIE["chr_date_added"] );
		$r_status = explode( '~chr~', $_COOKIE["chr_status"] );

		for ($r=0; $r < count($r_staff_id); $r++) { 
			if( $r_staff_id[$r] == $like || $r_lname[$r] == $like || $r_fname[$r] == $like || $r_mname[$r] == $like || $r_age[$r] == $like || $r_birthday[$r] == $like || $r_address[$r] == $like || $r_contact[$r] == $like || $r_date_added[$r] == $like ) {

				array_push($this->staff_id, $r_staff_id[$r]);
				array_push($this->lname, $r_lname[$r]);
				array_push($this->fname, $r_fname[$r]);
				array_push($this->mname, $r_mname[$r]);
				array_push($this->age, $r_age[$r]);
				array_push($this->birthday, $r_birthday[$r]);
				array_push($this->address, $r_address[$r]);
				array_push($this->contact, $r_contact[$r]);
				array_push($this->date_added, $r_date_added[$r]);
				array_push($this->status, $r_status[$r]);
			}
		}
	}
	protected function updatestaff() {
		$o_staff_id = explode( '~chr~', $_COOKIE["chr_staff_id"] );
		$o_lname = explode( '~chr~', $_COOKIE["chr_lname"] );
		$o_fname = explode( '~chr~', $_COOKIE["chr_fname"] );
		$o_mname = explode( '~chr~', $_COOKIE["chr_mname"] );
		$o_age = explode( '~chr~', $_COOKIE["chr_age"] );
		$o_birthday = explode( '~chr~', $_COOKIE["chr_birthday"] );
		$o_address = explode( '~chr~', $_COOKIE["chr_address"] );
		$o_contact = explode( '~chr~', $_COOKIE["chr_contact"] );
		$o_date_added = explode( '~chr~', $_COOKIE["chr_date_added"] );
		$o_status = explode( '~chr~', $_COOKIE["chr_status"] );

		$n_staff_id = "";
		$n_lname = "";
		$n_fname = "";
		$n_mname = "";
		$n_age = "";
		$n_birthday = "";
		$n_address = "";
		$n_contact = "";
		$n_date_added = "";
		$n_status = "";

		for ($r=0; $r < count($o_staff_id); $r++) { 
			if($o_staff_id[$r] == $this->staff_id) {
				if( ($r+1) == count($o_staff_id) ){
					$n_staff_id .= $this->staff_id;
					$n_lname .= $this->lname;
					$n_fname .= $this->fname;
					$n_mname .= $this->mname;
					$n_age .= $this->age;
					$n_birthday .= $this->birthday;
					$n_address .= $this->address;
					$n_contact .= $this->contact;
					$n_date_added .= $this->date_added;
					$n_status .= $this->status;
				} else {
					$n_staff_id .= $this->staff_id . "~chr~";
					$n_lname .= $this->lname . "~chr~";
					$n_fname .= $this->fname . "~chr~";
					$n_mname .= $this->mname . "~chr~";
					$n_age .= $this->age . "~chr~";
					$n_birthday .= $this->birthday . "~chr~";
					$n_address .= $this->address . "~chr~";
					$n_contact .= $this->contact . "~chr~";
					$n_date_added .= $this->date_added . "~chr~";
					$n_status .= $this->status . "~chr~";
				}
			} else {
				if( ($r+1) == count($o_staff_id) ){
					$n_staff_id .= $o_staff_id[$r];
					$n_lname .= $o_lname[$r];
					$n_fname .= $o_fname[$r];
					$n_mname .= $o_mname[$r];
					$n_age .= $o_age[$r];
					$n_birthday .= $o_birthday[$r];
					$n_address .= $o_address[$r];
					$n_contact .= $o_contact[$r];
					$n_date_added .= $o_date_added[$r];
					$n_status .= $o_status[$r];
				} else {
					$n_staff_id .= $o_staff_id[$r] . "~chr~";
					$n_lname .= $o_lname[$r] . "~chr~";
					$n_fname .= $o_fname[$r] . "~chr~";
					$n_mname .= $o_mname[$r] . "~chr~";
					$n_age .= $o_age[$r] . "~chr~";
					$n_birthday .= $o_birthday[$r] . "~chr~";
					$n_address .= $o_address[$r] . "~chr~";
					$n_contact .= $o_contact[$r] . "~chr~";
					$n_date_added .= $o_date_added[$r] . "~chr~";
					$n_status .= $o_status[$r] . "~chr~";
				}
			}
		}

		$cookie_name = ['chr_staff_id', 'chr_lname', 'chr_fname', 'chr_mname', 'chr_age', 'chr_birthday', 'chr_address', 'chr_contact', 'chr_date_added', 'chr_status'];
		$cookie_nvalue = [ $n_staff_id, $n_lname, $n_fname, $n_mname, $n_age, $n_birthday, $n_address, $n_contact, $n_date_added, $n_status];

		for ($r=0; $r < count($cookie_name); $r++) { 
			setcookie($cookie_name[$r], $cookie_nvalue[$r], time() + (86400 * 30), '/');
		}
	}
}

?>