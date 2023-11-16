<?php
include_once('./models/authentication_model.php');

session_start();
if (isset($_POST['login'])) {
  $username = htmlentities($_POST['username'], ENT_COMPAT, 'ISO-8859-1', true);
  $password = htmlentities(md5($_POST['password']), ENT_COMPAT, 'ISO-8859-1', true);

  $authModel = new AuthModel();
  if ($authModel->login_process($username, $password)) {
    header('location:index.php');
  } else {
    header('location:login.php?message=failed');
  }
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    if ($message == "failed") {
        echo '<div class="alert alert-danger" role="alert">Username atau Password Salah!</div>';
    } else {
        echo '<div class="alert alert-secondary" role="alert">'.$message.'</div>';
    }
}

include_once'./components/layer/header.php';
?>

<div class="container bg-body" style="position: relative; margin-top: 10%; padding-top: 3%; padding-bottom: 3%">
    <div class="block">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 pb-4">
                <h1>Login</h1><br/>
                <form method="POST">
                    <div class="form-group">
                        <label class="text-black" for="username">Username</label>
                        <input type="text" class="form-control" id="emusernameail" name="username" required>
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-primary-hover-outline" name="login">Login</button>
                </form><br/>
                <a href="register.php" class="text-center">Create An Account</a>
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