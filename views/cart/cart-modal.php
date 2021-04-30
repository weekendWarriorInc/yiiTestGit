<?php
use yii\helpers\Html;
?>
<?php if (!empty($session['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Найменування</th>
                    <th>Кількість</th>
                    <th>Ціна</th>
                    <th><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item) : ?>
                    <tr>
                  
                        <td><?= Html::img("@web/images/products/".$item['img'], ['alt'=> $item['name'], 'height'=>50]); ?></td>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['qty']; ?></td>
                        <td><?= $item['price']; ?></td>
                        <th><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item"></span></th>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Разом: </td>
                    <td> <?= $session['cart.qty']; ?></td>
                </tr>
                <tr>
                    <td colspan="4">На суму: </td>
                    <td> <?= $session['cart.sum']; ?></td>
                </tr>
            </tbody>

        </table>
    </div>
<?php else : ?>
    <h3>Кошик пустий</h3>
<?php endif; ?>