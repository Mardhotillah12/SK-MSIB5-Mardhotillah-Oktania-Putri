<!-- Start Column 2 -->
<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
    <a class="product-item" href="cart.php?action=add-to-cart&product_id=<?= $product['id'] ?>">
        <img src="images/<?= $product['image_url'] ?>" class="img-fluid product-thumbnail" />
        <h3 class="product-title"><?= $product['name'] ?></h3>
        <strong class="product-price">Rp.<?= number_format($product['price'], 0, '.', '.'); ?></strong>

        <span class="icon-cross">
            <img src="images/cross.svg" class="img-fluid" />
        </span>
    </a>
</div>
<!-- End Column 2 -->