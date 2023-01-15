<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Requirements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requirements-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
