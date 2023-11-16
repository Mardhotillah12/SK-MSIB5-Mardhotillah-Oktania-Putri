<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/product_model.php';
include_once'./models/cart_model.php';
include_once'./models/order_model.php';

$productModel = new ProductModel();
$cartModel = new CartModel();
$orderModel = new OrdertModel();
	
if (isset($_POST['checkout'])) {
	$full_name    	= $_POST['full_name'];
    $address    	= $_POST['address'];
    $email    		= $_POST['email'];
    $phone_number   = $_POST['phone_number'];
	$notes 			= $_POST['shipment_notes'];
	$user_id 		= $_SESSION['user_id'];
	$cart_master_id	= $_POST['cart_master_id'];
	$payment_method = "Bank Ada";
	$payment_status = "PAID";
	$total_order 	= $_POST['total_order'];

	$process = $orderModel->request_create_order($user_id, $cart_master_id, $payment_method, $payment_status, $total_order, $full_name, $address, $email, $phone_number, $notes);
	if ($process) {
		$processUpdateStatusCart = $cartModel->request_update_status_cart_master($cart_master_id);
		if ($processUpdateStatusCart) {
			header('location:thankyou.php');
		} else {
			echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
		}
	} else {
		echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
	}
}

$pageName = "Checkout";
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 
?>

<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Checkout</h1>
					</div>
				</div>
				<div class="col-lg-7">
					
				</div>
			</div>
		</div>
	</div>
<!-- End Hero Section -->

<div class="untree_co-section">
	<form method="post">
		<div class="container">
			<div class="row">
			<div class="col-md-6 mb-5 mb-md-0">
				<h2 class="h3 mb-3 text-black">Billing Details</h2>
				<div class="p-3 p-lg-5 border bg-white">
				<div class="form-group row">
					<div class="col-md-12">
					<label for="full_name" class="text-black">Full Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Mr. Bean">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
					<label for="address" class="text-black">Address <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="address" name="address" placeholder="Street address">
					</div>
				</div>

				<div class="form-group row mb-5">
					<div class="col-md-6">
					<label for="email" class="text-black">Email Address <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="email" name="email">
					</div>
					<div class="col-md-6">
					<label for="phone_number" class="text-black">Phone <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
					</div>
				</div>
				
				<div class="form-group">
					<label for="shipment_notes" class="text-black">Shipment Notes</label>
					<textarea name="shipment_notes" id="shipment_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
				</div>

				</div>
			</div>
			<div class="col-md-6">

				<div class="row mb-5">
				<div class="col-md-12">
					<h2 class="h3 mb-3 text-black">Your Order</h2>
					<div class="p-3 p-lg-5 border bg-white">
					<table class="table site-block-order-table mb-5">
						<thead>
						<th>Product</th>
						<th>Total</th>
						</thead>
						<tbody>
						<?php 
							$totalCart = 0;
							$cartMasterData = $cartModel->request_get_cart_master($_SESSION['user_id']);
							$cart_master_id = $cartMasterData['id'];
							if (isset($cartMasterData)) {
								$cartDetailList = $cartModel->request_get_cart_detail_list($cartMasterData['id']);
								if (isset($cartDetailList)) {
									$no = 0;
									foreach ($cartDetailList as $cartDetail) {
										$no++;
										$totalCart += $cartDetail['total_price'];
										$product = $productModel->request_product_detail($cartDetail['product_id']);
										include'./components/card/checkout_list.php';
									}
								} 
							} 
						?>
						
						<tr>
							<td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
							<td class="text-black">Rp.<?= number_format($totalCart, 0, '.', '.'); ?></td>
						</tr>
						<tr>
							<input type="text" name="cart_master_id" value="<?= $cart_master_id ?>" hidden>
							<input type="text" name="total_order" value="<?= $totalCart ?>" hidden>
							<td class="text-black font-weight-bold"><strong>Order Total</strong></td>
							<td class="text-black font-weight-bold"><strong>Rp.<?= number_format($totalCart, 0, '.', '.'); ?></strong></td>
						</tr>
						</tbody>
					</table>

					<div class="border p-3 mb-5">
						<h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Bank Ada</a></h3>

						<div class="collapse" id="collapsepaypal">
						<div class="py-2">
							<p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
						</div>
						</div>
					</div>

					<div class="form-group">
						<button class="btn btn-black btn-lg py-3 btn-block" name="checkout">Place Order</button>
					</div>

					</div>
				</div>
				</div>

			</div>
			</div>
			<!-- </form> -->
		</div>
	</form>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
