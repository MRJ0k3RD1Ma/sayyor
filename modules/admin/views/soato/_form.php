<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Soato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MHOBT_cod')->textInput() ?>

    <?= $form->field($model, 'res_id')->textInput() ?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'district_id')->textInput() ?>

    <?= $form->field($model, 'qfi_id')->textInput() ?>

    <?= $form->field($model, 'name_lot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'center_lot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_cyr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'center_cyr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'center_ru')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
