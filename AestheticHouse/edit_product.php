<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/cart_model.php';
include_once'./models/product_model.php';

$productModel = new ProductModel();

$product = $productModel->request_product_detail($_GET['productId']);

if (isset($_POST['edit-product'])) {
    $productId  = $_GET['productId'];
    $name       = $_POST['name'];
    $price      = $_POST['price'];

    $temp = $_FILES['image_product']['tmp_name'];
    $image_product = rand(0, 9999) . $_FILES['image_product']['name'];
    $size = $_FILES['image_product']['size'];
    $type = $_FILES['image_product']['type'];
    $folder = "images/";

    if (($type == 'image/jpeg' or $type == 'image/png')) {
        $process_upload = move_uploaded_file($temp, $folder . $image_product);
        if ($process_upload) {
            if ($productModel->request_update_product($productId, $name, $price, $image_product)) {
                header('location:manage_products.php');
            } else {
                echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
            }        
        }
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
						<h1>Edit Product</h1>
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
                  <label class="text-black" for="name">Product Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="price">Product Price</label>
                  <input type="number" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-black" for="email">Input Image</label>
                            <input type="file" class="form-control" id="file" name="image_product" value="<?= $product['image_url'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sofa-img">
                            <img src="images/<?= $product['image_url'] ?>" alt="Image" class="img-fluid" accept="image/*"/>
                        </div>
                    </div>

                </div>
                
                <button type="submit" class="btn btn-primary-hover-outline" name="edit-product">Edit</button>
            </form>
		</div>
		
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
