<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

debug($model->image);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <label class="control-label" for="product-category_id">Категорія</label>
    <select id="product-category_id" class="form-control" name="Product[category_id]" aria-invalid="false">
        <?= \app\components\MenuWidget::widget(['tpl' => 'select_product', 'model' => $model]) ?>
    </select>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
   /*  echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); */
    ?>
      <?php
   echo $form->field($model, 'content')->widget(CKEditor::className(), [
        
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
      
      ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    
    <?= $form->field($model, 'hit')->checkbox() ?>

    <?= $form->field($model, 'new')->checkbox()  ?>

    <?= $form->field($model, 'sale')->checkbox()  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>