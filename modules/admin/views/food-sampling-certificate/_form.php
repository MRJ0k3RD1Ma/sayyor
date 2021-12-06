<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FoodSamplingCertificate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-sampling-certificate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pnfl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sampling_site')->textInput() ?>

    <?= $form->field($model, 'sampling_adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sampler_organization_code')->textInput() ?>

    <?= $form->field($model, 'sampler_person_pnfl')->textInput() ?>

    <?= $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verification_sample')->textInput() ?>

    <?= $form->field($model, 'producer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacture_date')->textInput() ?>

    <?= $form->field($model, 'sell_by')->textInput() ?>

    <?= $form->field($model, 'coments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verification_pupose_id')->textInput() ?>

    <?= $form->field($model, 'sampling_rules_id')->textInput() ?>

    <?= $form->field($model, 'sample_condition_id')->textInput() ?>

    <?= $form->field($model, 'sampling_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'send_sample_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'explanations')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.food_sampling_certificate', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
