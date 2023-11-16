<tr>
    <td class="product-thumbnail">
    <img src="images/<?= $product['image_url'] ?>" alt="Image" class="img-fluid">
    </td>
    <td class="product-name">
    <h2 class="h5 text-black"><?= $product['name'] ?></h2>
    </td>
    <td>Rp.<?= number_format($product['price'], 0, '.', '.'); ?></td>
    <td>
    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
        <div class="input-group-prepend">
            <a href="cart.php?action=decrease-cart&product_id=<?= $product['id'] ?>" class="btn btn-outline-black decrease" type="button">&minus;</a>
        </div>
        <input type="text" class="form-control text-center quantity-amount" value="<?= $cartDetail['qty'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled>
        <div class="input-group-append">
            <a href="cart.php?action=increase-cart&product_id=<?= $product['id'] ?>" class="btn btn-outline-black increase" type="button">&plus;</a>
        </div>
    </div>

    </td>
    <td>Rp.<?= number_format($cartDetail['total_price'], 0, '.', '.'); ?></td>
    <td><a href="cart.php?action=delete-cart&product_id=<?= $product['id'] ?>" class="btn btn-black btn-sm">X</a></td>
</tr>