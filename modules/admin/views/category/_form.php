<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>



    

    <label class="control-label" for="category-parent_id">Батьківська категорія</label>
    <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-invalid="false">
        <?= \app\components\MenuWidget::widget(['tpl' => 'select', 'model'=>$model]) ?>
    </select>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>