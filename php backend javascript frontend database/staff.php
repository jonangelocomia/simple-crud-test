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
		$this->db = new PDO("mysql:host=" . $GLOBALS['host'] . ";dbname=" . $GLOBALS['dbname'] . ";charset=utf8mb4", $GLOBALS['user'], $GLOBALS['password']);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	protected function createstaff() {
		try {
			$this->db->beginTransaction();
			$stmt = $this->db->prepare("INSERT INTO staff ( staff_id,  lname,  fname,  mname,  age,  birthday,  address,  contact,  date_added,  status) VALUES ( null,  :lname,  :fname,  :mname,  :age,  :birthday,  :address,  :contact,  :date_added,   :status)");
			$stmt->execute(array("lname" => $this->lname, "fname" => $this->fname, "mname" => $this->mname, "age" => $this->age, "birthday" => $this->birthday, "address" => $this->address, "contact" => $this->contact, "date_added" => $this->date_added, "status" => $this->status));
			$affected_rows = $stmt->rowCount();
			$this->db->commit();
		}
		catch (PDOException $ex) {
			$this->db->rollBack();
			echo $ex->getMessage();
		}
	}
	protected function readstaff() {
		try {
			$this->db->beginTransaction();
			foreach($this->db->query("SELECT * FROM staff") as $row) {
				array_push($this->staff_id, $row["staff_id"]);
				array_push($this->lname, $row["lname"]);
				array_push($this->fname, $row["fname"]);
				array_push($this->mname, $row["mname"]);
				array_push($this->age, $row["age"]);
				array_push($this->birthday, $row["birthday"]);
				array_push($this->address, $row["address"]);
				array_push($this->contact, $row["contact"]);
				array_push($this->date_added, $row["date_added"]);
				array_push($this->status, $row["status"]);
			}
			$this->db->commit();
		}
		catch (PDOException $ex) {
			$this->db->rollBack();
			echo $ex->getMessage();
		}
	}
	protected function findstaff($like) {
		try {
			$this->db->beginTransaction();
			foreach($this->db->query("SELECT * FROM staff WHERE  staff_id LIKE '%" . $like . "%'  OR  lname LIKE '%" . $like . "%'  OR  fname LIKE '%" . $like . "%'  OR  mname LIKE '%" . $like . "%'  OR  age LIKE '%" . $like . "%'  OR  birthday LIKE '%" . $like . "%'  OR  address LIKE '%" . $like . "%'  OR  contact LIKE '%" . $like . "%' OR date_added LIKE '%" . $like . "%'  OR  status LIKE '%" . $like . "%' ") as $row) {
				array_push($this->staff_id, $row["staff_id"]);
				array_push($this->lname, $row["lname"]);
				array_push($this->fname, $row["fname"]);
				array_push($this->mname, $row["mname"]);
				array_push($this->age, $row["age"]);
				array_push($this->birthday, $row["birthday"]);
				array_push($this->address, $row["address"]);
				array_push($this->contact, $row["contact"]);
				array_push($this->date_added, $row["date_added"]);
				array_push($this->status, $row["status"]);
			}
			$this->db->commit();
		}
		catch (PDOException $ex) {
			$this->db->rollBack();
			echo $ex->getMessage();
		}
	}
	protected function updatestaff() {
		try {
			$this->db->beginTransaction();
			$stmt = $this->db->prepare("UPDATE staff SET lname = :lname,  fname = :fname,  mname = :mname,  age = :age,  birthday = :birthday,  address = :address,  contact = :contact,  date_added = :date_added,  status = :status WHERE staff_id = :staff_id");
			$stmt->execute(array("staff_id" => $this->staff_id, "lname" => $this->lname, "fname" => $this->fname, "mname" => $this->mname, "age" => $this->age, "birthday" => $this->birthday, "address" => $this->address, "contact" => $this->contact, "date_added" => $this->date_added, "status" => $this->status));
			$affected_rows = $stmt->rowCount();
			$this->db->commit();
		}
		catch (PDOException $ex) {
			$this->db->rollBack();
			echo $ex->getMessage();
		}
	}
}

?>