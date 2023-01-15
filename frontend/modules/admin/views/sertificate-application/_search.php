<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\SertificateApplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sertificate-application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'pnfl') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'fsc_id') ?>

    <?php // echo $form->field($model, 'vet_site_id') ?>

    <?php // echo $form->field($model, 'labaratory_test_type_id') ?>

    <?php // echo $form->field($model, 'emergency_check') ?>

    <?php // echo $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'check_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.sertificate_application', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.sertificate_application', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
