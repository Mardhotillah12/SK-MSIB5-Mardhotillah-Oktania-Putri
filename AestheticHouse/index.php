<?php 
include_once'./components/layer/login_checker.php';
include_once'./models/product_model.php';

$productModel = new ProductModel();

$pageName = "Home";
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 

?>

<!-- Start Hero Section -->
<div class="hero">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-5">
        <div class="intro-excerpt">
          <h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
          <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="hero-img-wrap">
          <img src="images/couch.png" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Hero Section -->

<!-- Start Product Section -->
<div class="product-section">
  <div class="container">
    <div class="row">
      <!-- Start Column 1 -->
      <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
        <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
        <p><a href="shop.php" class="btn">Explore</a></p>
      </div>
      <!-- End Column 1 -->

      <!-- Start Column 2-4 -->
      <?php 
      $productList = $productModel->request_product_list();
      foreach ($productList as $product) {
        include'./components/card/product.php';
      }
      ?>
      <!-- End Column 2-4 -->

    </div>
  </div>
</div>
<!-- End Product Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-6">
        <h2 class="section-title">Why Choose Us</h2>
        <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

        <div class="row my-5">
          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="images/truck.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Fast &amp; Free Shipping</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="images/bag.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Easy to Shop</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="images/support.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>24/7 Support</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <div class="icon">
                <img src="images/return.svg" alt="Image" class="imf-fluid" />
              </div>
              <h3>Hassle Free Returns</h3>
              <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="img-wrap">
          <img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Why Choose Us Section -->

<?php include_once'./components/layer/footer_page.php'; ?>
