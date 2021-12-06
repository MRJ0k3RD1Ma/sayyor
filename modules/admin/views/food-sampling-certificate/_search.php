<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\FoodSamplingCertificateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-sampling-certificate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kod') ?>

    <?= $form->field($model, 'pnfl') ?>

    <?= $form->field($model, 'organization_id') ?>

    <?= $form->field($model, 'sampling_site') ?>

    <?php // echo $form->field($model, 'sampling_adress') ?>

    <?php // echo $form->field($model, 'sampler_organization_code') ?>

    <?php // echo $form->field($model, 'sampler_person_pnfl') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'verification_sample') ?>

    <?php // echo $form->field($model, 'producer') ?>

    <?php // echo $form->field($model, 'serial_num') ?>

    <?php // echo $form->field($model, 'manufacture_date') ?>

    <?php // echo $form->field($model, 'sell_by') ?>

    <?php // echo $form->field($model, 'coments') ?>

    <?php // echo $form->field($model, 'verification_pupose_id') ?>

    <?php // echo $form->field($model, 'sample_box_id') ?>

    <?php // echo $form->field($model, 'sample_condition_id') ?>

    <?php // echo $form->field($model, 'sampling_date') ?>

    <?php // echo $form->field($model, 'send_sample_date') ?>

    <?php // echo $form->field($model, 'explanations') ?>

    <?php // echo $form->field($model, 'based_public_information') ?>

    <?php // echo $form->field($model, 'message_number') ?>

    <?php // echo $form->field($model, 'laboratory_test_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.food_sampling_certificate', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.food_sampling_certificate', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
