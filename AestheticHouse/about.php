<?php 
$pageName = "About Us";
include_once'./components/layer/login_checker.php';
include_once'./components/layer/header.php';
include_once'./components/layer/navbar.php'; 
?>

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6">
        <h2 class="section-title text-capitalize">Mardhotillah Oktania Putri</h2>
        <p>Politeknik Negeri Sriwijaya</p>

        <div class="row my-5">
          <div class="col-6 col-md-6">
            <div class="feature">
              <h3>NIM</h3>
              <p>062040832733</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <h3>Semester</h3>
              <p>7</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <h3>Kelas</h3>
              <p>Full Stack Web Development 01.</p>
            </div>
          </div>

          <div class="col-6 col-md-6">
            <div class="feature">
              <h3>Kampus Merdeka (Studi Independent)</h3>
              <p>Eduwork di Kota Yogyakarta.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="img-wrap">
          <img src="images/profile.jpeg" alt="Image" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Why Choose Us Section -->

<?php include_once'./components/layer/footer_page.php'; ?>
