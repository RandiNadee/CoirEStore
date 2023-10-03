<?php
session_start();
/**
 * 
 */
class Credentials
{

	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function createSystemAdminAccount($name, $email, $password)
	{
		$q = $this->con->query("SELECT email FROM admin WHERE email = '$email' AND user_type = '1'");
		if ($q->num_rows > 0) {
			return ['status' => 303, 'message' => 'Email already exists'];
		} else {
			$password = password_hash($password, PASSWORD_BCRYPT, ["COST" => 8]);
			$q = $this->con->query("INSERT INTO `admin`(`name`, `email`, `password`, `is_active`, `user_type`) VALUES ('$name','$email','$password','0', '1')");
			if ($q) {
				return ['status' => 202, 'message' => 'Admin Created Successfully'];
			}
		}
	}

	public function loginSystemAdmin($email, $password)
	{
		$q = $this->con->query("SELECT * FROM admin WHERE email = '$email' AND user_type='1' LIMIT 1");
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
			if (password_verify($password, $row['password'])) {
				$_SESSION['admin_name'] = $row['name'];
				$_SESSION['admin_id'] = $row['id'];
				$_SESSION['usert_type'] = $row['user_type'];
				return ['status' => 202, 'message' => 'Login Successful'];
			} else {
				return ['status' => 303, 'message' => 'Login Fail'];
			}
		} else {
			return ['status' => 303, 'message' => 'Account not created yet with this email'];
		}
	}

	public function logoutAdmin($admin_id){
		$q = $this->con->query("UPDATE admin SET is_active = '0' WHERE id = '$admin_id'");
	}
}

if (isset($_POST['admin_register'])) {
	extract($_POST);
	if (!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {
		if ($password == $cpassword) {
			$c = new Credentials();
			$result = $c->createSystemAdminAccount($name, $email, $password);
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

if (isset($_POST['admin_login'])) {
	extract($_POST);
	if (!empty($email) && !empty($password)) {
		$c = new Credentials();
		$result = $c->loginSystemAdmin($email, $password);
		echo json_encode($result);
		exit();
	} else {
		echo json_encode(['status' => 303, 'message' => 'Empty fields']);
		exit();
	}
}

if (isset($_POST['salesmanager_logout'])) {
	extract($_POST);
	if (!empty($admin_id)) {
		$c = new Credentials();
		$result = $c->logoutAdmin($admin_id);
		if (isset($_SESSION["admin_id"])) {
			session_destroy();
		}
		echo json_encode(['status'=> 202, 'message'=> "Logout successfully"]); 
		exit();
	}
}
