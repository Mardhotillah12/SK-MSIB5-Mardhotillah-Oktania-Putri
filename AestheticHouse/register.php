<?php
include_once('./models/authentication_model.php');
include_once('./models/user_model.php');

if (isset($_POST['register'])) {
    $username   = $_POST['username'];
    $password   = htmlentities(md5($_POST['password']), ENT_COMPAT, 'ISO-8859-1', true);
    $email      = $_POST['email'];
    $full_name  = $_POST['full_name'];
    $region     = $_POST['region'];

    $userModel = new UserModel();
    $userData = $userModel->request_user_detail($username);

    if ($userData['username'] != $username) {
        $authModel = new AuthModel();
        if ($authModel->register_process($username, $password, $email, $full_name, $region)) {
            header('location:login.php?message="register_success"');
        } else {
            echo '
            <div class="alert alert-danger" role="alert">
                Register Gagal, Silahkan Coba Lagi
            </div>
            ';
        }
    } else {
        echo '
        <div class="alert alert-danger" role="alert">
            Register Gagal! Username Sudah Digunakan. Silahkan Gunakan Username Yang Lain
        </div>
        ';
    }
}

include_once'./components/layer/header.php';
?>

<div class="container bg-body" style="position: relative; margin-top: 10%; padding-top: 3%; padding-bottom: 3%">
    <div class="block">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 pb-4">
                <h1>Register</h1><br/>
                <form method="POST">
                    <div class="form-group">
                        <label class="text-black" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required> 
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="region">Region</label>
                        <input type="text" class="form-control" id="region" name="region" required>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-primary-hover-outline" name="register">Register</button>
                </form><br/>
                <a href="login.php" class="text-center">Do you have an Account ?</a>
            </div>
        </div>
    </div>
</div>


<? include'./components/layer/footer.php';?>

<script type="text/javascript">
  function isNumber(event) {
    var keycode = event.keyCode;
    if (keycode > 47 && keycode < 58) {
      return true;
    } else {
      return false;
    }
  }
</script>