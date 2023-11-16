<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/order_model.php';

$ordertModel = new OrdertModel();

$order = $ordertModel->request_order_detail($_SESSION['user_id'], $_GET['cartMasterId']);

if (isset($_POST['edit-order'])) {
    $full_name    	= $_POST['full_name'];
    $address    	= $_POST['address'];
    $email    		= $_POST['email'];
    $phone_number   = $_POST['phone_number'];
	$notes 			= $_POST['notes'];
	$user_id 		= $_SESSION['user_id'];
	$cart_master_id	= $_GET['cartMasterId'];
	$payment_method = $_POST['payment_method'];
	$payment_status = $_POST['payment_status'];
	$total_order 	= $_POST['total_order'];

    $process = $ordertModel->request_update_order($cart_master_id, $payment_method, $payment_status, $total_order, $full_name, $address, $email, $phone_number, $notes);
    if ($process) {
        header('location:manage_orders.php');
    } else {
        echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
    }
}


$pageName = "Cart";
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 
?>

<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Edit Order</h1>
					</div>
				</div>
				<div class="col-lg-7">
					
				</div>
			</div>
		</div>
	</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
	<div class="container">
		<div class="row mb-5">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="text-black" for="cart_master_id">ID Cart Master</label>
                  <input type="text" class="form-control" id="cart_master_id" name="cart_master_id" value="<?= $order['cart_master_id'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label class="text-black" for="payment_method">Payment Method</label>
                  <input type="text" class="form-control" id="payment_method" name="payment_method" value="<?= $order['payment_method'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="payment_status">Payment Method</label>
                  <input type="text" class="form-control" id="payment_status" name="payment_status" value="<?= $order['payment_status'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="total_order">Total Order</label>
                  <input type="text" class="form-control" id="total_order" name="total_order" value="<?= $order['total_order'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="total_order">Total Order</label>
                  <input type="text" class="form-control" id="total_order" name="total_order" value="<?= $order['total_order'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $order['full_name'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="email">Address</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $order['email'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="phone_number">Address</label>
                  <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?= $order['phone_number'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" value="<?= $order['address'] ?>" required>
                </div>
                <div class="form-group mb-5">
                  <label class="text-black" for="notes">Notes</label>
                  <input type="text" class="form-control" id="notes" name="notes" value="<?= $order['notes'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary-hover-outline" name="edit-order">Edit</button>
            </form>
		</div>
		
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
