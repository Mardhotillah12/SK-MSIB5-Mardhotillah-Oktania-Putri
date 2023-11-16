<?php
include_once('dbconnect.php');

class AuthModel
{
	public function check_user_already_login() {
		session_start();
		if ($_SESSION['is_login']) {
			return true;
		} else {
			return false;
		}
	}

	public function login_process($username, $password) {
		$conn = new Connection();
		$dataSql = mysqli_query($conn->koneksi, "select * from tb_user where username='$username' and password='$password'");
		$data = $dataSql->fetch_array();
		if ($username == $data['username'] and $password == $data['password']) {
			session_start();
			$_SESSION['user_id']    = $data['id'];
			$_SESSION['nama'] 		= $data['nama'];
			$_SESSION['username']   = $data['username'];
			$_SESSION['is_login'] 	= true;
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function register_process($username, $password, $email, $full_name, $region) {
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "INSERT INTO tb_user (username, password, email, full_name, region) VALUES ('$username', '$password', '$email', '$full_name', '$region')");
		return $query;
	}
}
