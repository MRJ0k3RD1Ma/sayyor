<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SoatoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MHOBT_cod') ?>

    <?= $form->field($model, 'res_id') ?>

    <?= $form->field($model, 'region_id') ?>

    <?= $form->field($model, 'district_id') ?>

    <?= $form->field($model, 'qfi_id') ?>

    <?php // echo $form->field($model, 'name_lot') ?>

    <?php // echo $form->field($model, 'center_lot') ?>

    <?php // echo $form->field($model, 'name_cyr') ?>

    <?php // echo $form->field($model, 'center_cyr') ?>

    <?php // echo $form->field($model, 'name_ru') ?>

    <?php // echo $form->field($model, 'center_ru') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
