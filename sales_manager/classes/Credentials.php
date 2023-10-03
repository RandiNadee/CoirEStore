<?php 
session_start();

class Credentials
{
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function loginAdmin($email, $password){
		$q = $this->con->query("SELECT * FROM admin WHERE email = '$email' AND user_type = '2' LIMIT 1");
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
			if (password_verify($password, $row['password'])) {
				$_SESSION['admin_name'] = $row['name'];
				$_SESSION['admin_id'] = $row['id'];
				$_SESSION['user_type'] = $row['user_type'];
				$q = $this->con->query("UPDATE admin SET is_active = '1' WHERE email = '$email' AND user_type = '2'");
				return ['status'=> 202, 'message'=> 'Login Successful'];
			}else{
				return ['status'=> 303, 'message'=> 'Login Fail'];
			}
		}else{
			return ['status'=> 303, 'message'=> 'Account not created yet with this email'];
		}
	}

	public function logoutAdmin($admin_id){
		$q = $this->con->query("UPDATE admin SET is_active = '0' WHERE id = '$admin_id'");
	}

}

if (isset($_POST['salesmanager_login'])) {
	extract($_POST);
	if (!empty($email) && !empty($password)) {
		$c = new Credentials();
		$result = $c->loginAdmin($email, $password);
		echo json_encode($result);
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
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

?>