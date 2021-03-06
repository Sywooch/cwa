<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Center */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="center-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region')->dropDownList($model->regions_array) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'meta_title')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'gmap_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gmap_lng')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
