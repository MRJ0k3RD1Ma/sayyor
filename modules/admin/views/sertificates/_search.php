<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SertificatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sertificates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sert_id') ?>

    <?= $form->field($model, 'sert_num') ?>

    <?= $form->field($model, 'sert_date') ?>

    <?= $form->field($model, 'organization_id') ?>

    <?= $form->field($model, 'pnfl') ?>

    <?php // echo $form->field($model, 'owner_name') ?>

    <?php // echo $form->field($model, 'vet_site_id') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.sertificates', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.sertificates', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
