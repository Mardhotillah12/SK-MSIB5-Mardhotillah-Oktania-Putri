<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/user_model.php';

$userModel = new UserModel();

$profile = $userModel->request_user_detail($_SESSION['username']);

if (isset($_POST['change-password'])) {
    $oldPassword = htmlentities(md5($_POST['old_passowrd']), ENT_COMPAT, 'ISO-8859-1', true);
    $newPassword = htmlentities(md5($_POST['new_password']), ENT_COMPAT, 'ISO-8859-1', true);
    $confirmPassword = htmlentities(md5($_POST['confirm_password']), ENT_COMPAT, 'ISO-8859-1', true);

    $username = $_SESSION['username'];
    if ($newPassword == $confirmPassword) {
        $processChangePassword = $userModel->request_change_password($username, $oldPassword, $newPassword);
        if ($processChangePassword) {
            echo '<div class="alert alert-success" role="alert">Change Password Success</div>';
        } else {
            echo '<div class="alert alert-secondary" role="alert">Sorry, a system error occurred.</div>';
        }
    } else {
        echo '<div class="alert alert-secondary" role="alert">Sorry, Password doesnt match.</div>';
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
						<h1>Change Password</h1>
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
                  <label class="text-black" for="old_password">Old Password</label>
                  <input type="password" class="form-control" id="old_password" name="old_passowrd" required>
                </div>
                <div class="form-group">
                  <label class="text-black" for="new_password">New Password</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group mb-5">
                  <label class="text-black" for="confirm_password">Confirm Password</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary-hover-outline" name="change-password">Edit</button>
            </form>
		</div>
		
	</div>
</div>

<?php include_once'./components/layer/footer_page.php'; ?>
