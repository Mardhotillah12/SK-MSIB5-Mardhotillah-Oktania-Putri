<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/user_model.php';

$userModel = new UserModel();

$profile = $userModel->request_user_detail($_SESSION['username']);

if (isset($_POST['edit-profile'])) {
    $name            = $_POST['name'];
    $price           = $_POST['price'];

    $temp = $_FILES['image_product']['tmp_name'];
    $image_product = rand(0, 9999) . $_FILES['image_product']['name'];
    $size = $_FILES['image_product']['size'];
    $type = $_FILES['image_product']['type'];
    $folder = "images/";

    if (($type == 'image/jpeg' or $type == 'image/png')) {
        $processMove = move_uploaded_file($temp, $folder . $image_product);
        if ($processMove) {
            if ($productModel->request_create_product($name, $price, $image_product)) {
                header('location:manage_products.php');
            } else {
                echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
            }
        } else {
            echo '<div class="alert alert-secondary" role="alert">Maaf, Terjadi Kesalahan. Silahkan Coba Lagi</div>';
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
						<h1>Profile Page</h1>
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
                  <label class="text-black" for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= $profile['username'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label class="text-black" for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $profile['email'] ?>" disabled>
                </div>
                <div class="form-group">
                  <label class="text-black" for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $profile['full_name'] ?>" required>
                </div>
                <div class="form-group mb-5">
                  <label class="text-black" for="region">Region</label>
                  <input type="text" class="form-control" id="region" name="region" value="<?= $profile['region'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary-hover-outline" name="edit-product">Edit</button>
            </form>
		</div>
		
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
