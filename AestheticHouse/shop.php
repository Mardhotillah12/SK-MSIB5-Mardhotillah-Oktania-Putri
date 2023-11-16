<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/product_model.php';

$productModel = new ProductModel();

$pageName = "Shop";
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 
?>

<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Shop</h1>
					</div>
				</div>
				<div class="col-lg-7">
					
				</div>
			</div>
		</div>
	</div>
<!-- End Hero Section -->

<div class="untree_co-section product-section before-footer-section">
	<div class="container">
		<div class="row">

			<!-- Start Column 1-4 -->
			<?php 
			$productList = $productModel->request_product_list();
			$productList[] = $productList[1];
			foreach($productList as $product) {
				include'./components/card/product.php';
			}
			?>
			<!-- End Column 1-4 -->
			
			<!-- Start Column 1-4 -->
			<?php 
			$productList = $productModel->request_product_list();
			$productList[] = $productList[1];
			foreach($productList as $product) {
				include'./components/card/product.php';
			}
			?>
			<!-- End Column 1-4 -->

		</div>
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>