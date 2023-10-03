<?php

class SalesManagers {
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getSalesManagersList(){
		$query = $this->con->query("SELECT `id`, `name`, `email`, `is_active` FROM `admin` WHERE `user_type` = '2'");
		$ar = [];
		if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
				$ar[] = $row;
			}
			return ['status'=> 202, 'message'=> $ar];
		}
		return ['status'=> 303, 'message'=> 'No Sales Managers'];
	}

    public function createSalesManagerAccount($name, $email, $password)
	{
		$q = $this->con->query("SELECT email FROM admin WHERE email = '$email' AND user_type = '2'");
		if ($q->num_rows > 0) {
			return ['status' => 303, 'message' => 'Email already exists'];
		} else {
			$password = password_hash($password, PASSWORD_BCRYPT, ["COST" => 8]);
			$q = $this->con->query("INSERT INTO `admin`(`name`, `email`, `password`, `is_active`, `user_type`) VALUES ('$name','$email','$password','0', '2')");
			if ($q) {
				return ['status' => 202, 'message' => 'Sales Manager Created Successfully'];
			}
		}
	}

	public function updateSalesManagerAccount($name, $email, $password){
		$q = $this->con->query("SELECT email FROM admin WHERE email = '$email' AND user_type = '2'");
		if ($q->num_rows > 0) {
			$password = password_hash($password, PASSWORD_BCRYPT, ["COST" => 8]);
			$q = $this->con->query("UPDATE admin SET `name` = '$name', `password` = '$password'  WHERE `email` = '$email'");
			if ($q) {
				return ['status' => 202, 'message' => 'Password Updated Successfully'];
			}
		}else{
			return ['status' => 303, 'message' => 'Sales Manager Account does not exist'];
		}
	}

	public function deleteSalesManager($id){
		if ($id != null) {
			$q = $this->con->query("DELETE FROM admin WHERE id = '$id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Sales manager account deleted'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to proceed, try again'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid sales manager id'];
		}
	}

}


if (isset($_POST['GET_SALES_MANAGERS'])) {
	$a = new SalesManagers();
	echo json_encode($a->getSalesManagersList());
	exit();
	
}

if (isset($_POST['SALES_MANAGERS_REGISTER'])) {
	extract($_POST);
	if (!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {
		if ($password == $cpassword) {
			$c = new SalesManagers();
			$result = $c->createSalesManagerAccount($name, $email, $password);
			echo json_encode($result);
			exit();
		} else {
			echo json_encode(['status' => 303, 'message' => 'Password mismatch']);
			exit();
		}
	} else {
		echo json_encode(['status' => 303, 'message' => 'Empty fields']);
		exit();
	}
}

if (isset($_POST['SALES_MANAGERS_UPDATE'])) {
	extract($_POST);
	if (!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {
		if ($password == $cpassword) {
			$c = new SalesManagers();
			$result = $c->updateSalesManagerAccount($name, $email, $password);
			echo json_encode($result);
			exit();
		} else {
			echo json_encode(['status' => 303, 'message' => 'Password mismatch']);
			exit();
		}
	} else {
		echo json_encode(['status' => 303, 'message' => 'Empty fields']);
		exit();
	}
}

if (isset($_POST['DELETE_SALES_MANAGER'])) {
	if (!empty($_POST['userid'])) {
		$p = new SalesManagers();
		echo json_encode($p->deleteSalesManager($_POST['userid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid request']);
		exit();
	}

	// if (!empty($_POST['userid'])) {
	// 	$userid = $_POST['userid'];
	// 	$q = $this->con->query("DELETE FROM admin WHERE id = '$userid'");
	// 	if ($q) {
	// 		echo json_encode(['status'=> 202, 'message'=> 'Sales Manager Deleted.']);
	// 	}else{
	// 		echo json_encode(['status'=> 202, 'message'=> 'Unable Delete, Try Again.']);
	// 	}
	// } else {
	// 	echo json_encode(['status' => 303, 'message' => 'Invalid Sales Manager Id.']);
	// 	exit();
	// }
}

?>