<?php
use yii\helpers\Html;

?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
               
                    <th>Найменування</th>
                    <th>Кількість</th>
                    <th>Ціна</th>
                    <th>Сума</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item) : ?>
                    <tr>
                  
               
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['qty']; ?></td>
                        <td><?= $item['price']; ?></td>
                        <td><?= $item['price'] * $item['qty']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3">Разом: </td>
                    <td> <?= $session['cart.qty']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">На суму: </td>
                    <td> <?= $session['cart.sum']; ?></td>
                </tr>
            </tbody>

        </table>
    </div>
