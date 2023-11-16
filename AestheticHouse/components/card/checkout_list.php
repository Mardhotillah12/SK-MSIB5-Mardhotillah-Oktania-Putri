<tr>
    <td><?= $product['name'] ?> <strong class="mx-2">x</strong> <?= $cartDetail['qty'] ?></td>
    <td>Rp.<?= number_format($cartDetail['total_price'], 0, '.', '.'); ?></td>
</tr>