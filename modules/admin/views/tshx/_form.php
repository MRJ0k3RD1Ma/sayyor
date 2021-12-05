<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tshx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tshx-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.tshx', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
