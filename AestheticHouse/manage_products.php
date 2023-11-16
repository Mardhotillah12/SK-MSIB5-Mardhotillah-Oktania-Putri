<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/cart_model.php';
include_once'./models/product_model.php';

$productModel = new ProductModel();

if (isset($_GET['action']) && isset($_GET['productId'])) {
    $action = $_GET['action'];
    $productId = $_GET['productId'];

    if ($action === "delete-product") {
        $processDelete = $productModel->request_delete_product($productId);
        if ($processDelete) {
            header('location:manage_products.php');
        } else {
            echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
        }
    }
}


$pageName = "Manage Products";
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 
?>

<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Manage Your Products</h1>
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
            <p><a href="add_product.php" class="btn">Add Product</a></p>
			<div class="site-blocks-table">
			<table class="table">
				<thead>
					<tr>
						<th class="product-quantity">No</th>
						<th class="product-thumbnail">Image</th>
						<th class="product-name">Name</th>
						<th class="product-price">Price</th>
						<th class="product-thumbnail">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no = 0;
                        $productList = $productModel->request_product_list();
                        if (isset($productList)) {
                            foreach ($productList as $product) {
                                $no++;
                                include'./components/card/manage_product.php';
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
