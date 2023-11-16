<?php
include_once('dbconnect.php');

class ProductModel
{
	public function request_product_list()
	{
		$conn = new Connection();
		$data = mysqli_query($conn->koneksi, "SELECT * FROM tb_product");
		while ($row = mysqli_fetch_array($data)) {
			$dataList[] = $row;
		}
		return $dataList ?? null;
	}

    public function request_product_detail($product_id)
	{
		$conn = new Connection();
		$data = mysqli_query($conn->koneksi, "SELECT * FROM tb_product WHERE id='$product_id'");
        return $data->fetch_array();	
    }

	function request_delete_product($product_id)
	{
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "DELETE from tb_product WHERE id=$product_id");
		return $query;
	}

	public function request_create_product($name, $price, $image_url) {
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "INSERT INTO tb_product (name, price, image_url) VALUES ('$name', '$price', '$image_url')");
		return $query;
	}

	public function request_update_product($product_id, $name, $price, $image_url) {
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "UPDATE tb_product  
                                                SET name='$name', price='$price', image_url='$image_url'
                                                WHERE id='$product_id'");
		return $query;
	}
}