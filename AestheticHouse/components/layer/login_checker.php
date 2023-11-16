<?php 
include_once'./models/authentication_model.php';

$authModel = new AuthModel();
if (!$authModel->check_user_already_login()) {
  header('location:login.php');
}
?>