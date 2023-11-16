<?php
include_once('dbconnect.php');
include_once('product_model.php');
class CartModel
{
	public function request_add_to_cart($user_id, $status, $product_id, $qty)
	{
        $productModel = new ProductModel();
        $productData = $productModel->request_product_detail($product_id);

		$cartMasterData = $this->request_get_cart_master($user_id);
        if (isset($cartMasterData)) {
            $cartDetailData = $this->request_get_cart_detail($product_id, $cartMasterData['id']);
            if ($cartDetailData['product_id'] == $product_id) {
                $qty = $qty + $cartDetailData['qty'];
                $total_price = $qty * $productData['price'];
                return $this->request_update_cart_detail($product_id, $cartMasterData['id'], $qty, $total_price);
            } else {
                return $this->request_create_cart_detail($cartMasterData['id'], $product_id, $qty, $productData['price']);
            }
        } else {
            $createCartMasterData = $this->request_create_cart_master($user_id, $status, $productData['price']);
            $getCartMasterData = $this->request_get_cart_master($user_id);
            
            if ($createCartMasterData) {
                return $this->request_create_cart_detail($getCartMasterData['id'], $product_id, $qty, $productData['price']);
            } else { 
                return false;
            }
        }
	}

    // CART MASTER 

    private function request_create_cart_master($user_id, $status) {
        $conn = new Connection();
		$query = mysqli_query($conn->koneksi, "INSERT INTO tb_cart_master (user_id, status) VALUES ('$user_id', '$status')");
		return $query;
    }

    public function request_get_cart_master($user_id) {
        $conn = new Connection();
        $data = mysqli_query($conn->koneksi, "SELECT * FROM tb_cart_master WHERE user_id='$user_id' AND status='UNPAID'");
		return $data->fetch_array();
    }

    public function request_update_status_cart_master($cart_master_id) {
        $conn = new Connection();
        $query = mysqli_query($conn->koneksi, "UPDATE tb_cart_master  
                                                SET status='PAID' 
                                                WHERE id='$cart_master_id'");
		return $query;
    }

    function request_delete_cart_master($user_id)
	{
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "DELETE from tb_cart_master WHERE user_id=$user_id");
		return $query;
	}

    // CART DETAIL

    private function request_create_cart_detail($cart_master_id, $product_id, $qty, $total_price) {
        $conn = new Connection();
		$query = mysqli_query($conn->koneksi, "INSERT INTO tb_cart_detail (cart_master_id, product_id, qty, total_price) 
                                                VALUES ('$cart_master_id', '$product_id', '$qty', '$total_price')");
		return $query;
    }

    public function request_update_cart_detail($product_id, $cart_master_id, $qty, $total_price) {
        $conn = new Connection();
		$query = mysqli_query($conn->koneksi, "UPDATE tb_cart_detail  
                                                SET qty='$qty', total_price='$total_price' 
                                                WHERE product_id='$product_id' AND cart_master_id='$cart_master_id'");
		return $query;
    }

    public function request_get_cart_detail($product_id, $cart_master_id) {
        $conn = new Connection();
		$data = mysqli_query($conn->koneksi, "SELECT * FROM tb_cart_detail 
                                                WHERE product_id='$product_id' AND cart_master_id='$cart_master_id'");
		return $data->fetch_array();
    }

    public function request_get_cart_detail_list($cart_master_id)
	{
		$conn = new Connection();
		$data = mysqli_query($conn->koneksi, "SELECT * FROM tb_cart_detail WHERE cart_master_id='$cart_master_id'");
		while ($row = mysqli_fetch_array($data)) {
			$dataList[] = $row;
		}
		return $dataList ?? null;
	}

    function request_delete_cart_detail($product_id)
	{
		$conn = new Connection();
		$query = mysqli_query($conn->koneksi, "DELETE from tb_cart_detail WHERE product_id=$product_id");
		return $query;
	}
}