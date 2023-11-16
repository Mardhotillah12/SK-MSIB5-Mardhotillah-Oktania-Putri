<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/cart_model.php';
include_once'./models/product_model.php';

$cartModel = new CartModel();
$productModel = new ProductModel();

if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $action 	= $_GET['action'];
	$productId 	= $_GET['product_id'];
	$userId 	= $_SESSION['user_id'];
	$status 	= "UNPAID";
	$qty 		= 1;
	if ($action === "add-to-cart") {
		$requestAddToCart = $cartModel->request_add_to_cart($userId, $status, $productId, $qty);
		if ($requestAddToCart) {
			header('location:cart.php');
		} else {
			echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
		}
	} else if ($action === "delete-cart") {
		$requestDeleteCartDetail = $cartModel->request_delete_cart_detail($productId);
		if ($requestDeleteCartDetail) {
			$cartMasterData = $cartModel->request_get_cart_master($userId);
			if (isset($cartMasterData)) {
				$cartDetailList = $cartModel->request_get_cart_detail_list($cartMasterData['id']);
				if (isset($cartDetailList)) {
					header('location:cart.php');
				} else {
					$requestDeleteCartMaster = $cartModel->request_delete_cart_master($userId);
					if ($requestDeleteCartMaster) {
						header('location:cart.php');
					} else {
						echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
					}
				}
			}
		} else {
			echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
		}
	} else if ($action === "increase-cart") {
		$productData = $productModel->request_product_detail($productId);
		$cartMasterData = $cartModel->request_get_cart_master($userId);
		$cartMasterId 	= $cartMasterData['id'];
		$cartDetailData = $cartModel->request_get_cart_detail($productId, $cartMasterId);
		$qty 			= $cartDetailData['qty'] + 1;
		$total_price 	= $qty * $productData['price'];
		$requestIncreaseCart = $cartModel->request_update_cart_detail($productId, $cartMasterId, $qty, $total_price);
		if ($requestIncreaseCart) {
			header('location:cart.php');
		} else {
			echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
		}
	} else if ($action === "decrease-cart") {
		$productData = $productModel->request_product_detail($productId);
		$cartMasterData = $cartModel->request_get_cart_master($userId);
		$cartMasterId 	= $cartMasterData['id'];
		$cartDetailData = $cartModel->request_get_cart_detail($productId, $cartMasterId);
		$qty 			= $cartDetailData['qty'] - 1;
		$total_price 	= $qty * $productData['price'];
		$requestDecreaseCart = $cartModel->request_update_cart_detail($productId, $cartMasterId, $qty, $total_price);
		if ($requestDecreaseCart) {
			header('location:cart.php');
		} else {
			echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
		}
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
						<h1>Cart</h1>
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
			<div class="site-blocks-table">
			<table class="table">
				<thead>
					<tr>
						<th class="product-thumbnail">Image</th>
						<th class="product-name">Product</th>
						<th class="product-price">Price</th>
						<th class="product-quantity">Quantity</th>
						<th class="product-total">Total</th>
						<th class="product-remove">Remove</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$totalCart = 0;
						$cartMasterData = $cartModel->request_get_cart_master($_SESSION['user_id']);
						if (isset($cartMasterData)) {
							$cartDetailList = $cartModel->request_get_cart_detail_list($cartMasterData['id']);
							if (isset($cartDetailList)) {
								$no = 0;
								foreach ($cartDetailList as $cartDetail) {
									$no++;
									$totalCart += $cartDetail['total_price'];
									$product = $productModel->request_product_detail($cartDetail['product_id']);
									include'./components/card/cart_list.php';
								}
							} else {
								include_once'./components/card/empty_data_row.php';
							}
						} else {
                            include_once'./components/card/empty_data_row.php';
                        }
					?>
				</tbody>
			</table>
			</div>
		</div>

		<?php if (isset($cartDetailList)) { ?>
			<div class="row">
				<div class="col-md-6">
					<div class="row mb-5">
						
					</div>
				</div>
				<div class="col-md-6 pl-5">
					<div class="row justify-content-end">
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-12 text-right border-bottom mb-5">
									<h3 class="text-black h4 text-uppercase">Cart Totals</h3>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-6">
									<span class="text-black">Subtotal</span>
								</div>
								<div class="col-md-6 text-right">
									<strong class="text-black">Rp.<?= number_format($totalCart, 0, '.', '.'); ?></strong>
								</div>
							</div>
							<div class="row mb-5">
								<div class="col-md-6">
									<span class="text-black">Total</span>
								</div>
								<div class="col-md-6 text-right">
									<strong class="text-black">Rp.<?= number_format($totalCart, 0, '.', '.'); ?></strong>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
