<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/order_model.php';

$orderModel = new OrdertModel();

if (isset($_GET['action']) && isset($_GET['cartMasterId'])) {
    $action = $_GET['action'];
    $cartMasterId = $_GET['cartMasterId'];

    if ($action === "delete-order") {
        $processDelete = $orderModel->request_delete_order($cartMasterId);
        if ($processDelete) {
            header('location:manage_orders.php');
        } else {
            echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
        }
    }
}

$pageName = "Manage Orders";
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 
?>

<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Manage Orders</h1>
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
						<th class="product-quantity">No</th>
						<th class="product-thumbnail">ID Cart Master</th>
						<th class="product-name">Status</th>
						<th class="product-price">Total Order</th>
						<th class="product-thumbnail">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no = 0;
                        $orderList = $orderModel->request_order_list($_SESSION['user_id']);
                        if (isset($orderList)) {
                            foreach ($orderList as $order) {
                                $no++;
                                include'./components/card/manage_order.php';
                            }
                        } else {
							include_once'./components/card/empty_data_row.php';
                        }
					?>
				</tbody>
			</table>
			</div>
		</div>
		
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
