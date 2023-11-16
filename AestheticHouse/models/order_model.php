<?php
include_once('dbconnect.php');

class OrdertModel
{
	public function request_order_detail($user_id, $cart_master_id)
	{
		$conn = new Connection();
		$data = mysqli_query($conn->koneksi, "SELECT * FROM tb_order WHERE user_id='$user_id' AND cart_master_id='$cart_master_id'");
		return $data->fetch_array();
	}

	public function request_order_list($user_id)
	{
		$conn = new Connection();
		$data = mysqli_query($conn->koneksi, "SELECT * FROM tb_order WHERE user_id='$user_id'");
		while ($row = mysqli_fetch_array($data)) {
			$dataList[] = $row;
		}
		return $dataList ?? null;
	}

	public function request_create_order($user_id, $cart_master_id, $payment_method, $payment_status, $total_order, $full_name, $address, $email, $phone_number, $notes) {
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "INSERT INTO tb_order (user_id, cart_master_id, payment_method, payment_status, total_order, full_name, address, email, phone_number, notes) VALUES ('$user_id', '$cart_master_id', '$payment_method', '$payment_status', '$total_order', '$full_name', '$address', '$email', '$phone_number', '$notes')");
		return $query;
	}
	
	public function request_update_order($cart_master_id, $payment_method, $payment_status, $total_order, $full_name, $address, $email, $phone_number, $notes) {
        $conn = new Connection();
        $query = mysqli_query($conn->koneksi, "UPDATE tb_order  
                                                SET  payment_method='$payment_method', payment_status='$payment_status', total_order='$total_order', full_name='$full_name', address='$address', email='$email', phone_number='$phone_number', notes='$notes' 
                                                WHERE cart_master_id='$cart_master_id'");
		return $query;
    }

	function request_delete_order($cart_master_id)
	{
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "DELETE FROM tb_order WHERE cart_master_id=$cart_master_id");
		return $query;
	}
}