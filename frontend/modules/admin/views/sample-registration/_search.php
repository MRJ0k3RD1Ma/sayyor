<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SampleRegistrationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-registration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pnfl') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'is_research') ?>

    <?= $form->field($model, 'code_id') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'research_category_id') ?>

    <?php // echo $form->field($model, 'results_conformity_id') ?>

    <?php // echo $form->field($model, 'organization_id') ?>

    <?php // echo $form->field($model, 'emp_id') ?>

    <?php // echo $form->field($model, 'reg_date') ?>

    <?php // echo $form->field($model, 'reg_id') ?>

    <?php // echo $form->field($model, 'sender_name') ?>

    <?php // echo $form->field($model, 'sender_phone') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'ads') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'res') ?>

    <?php // echo $form->field($model, 'res_id') ?>

    <?php // echo $form->field($model, 'registon_id') ?>

    <?php // echo $form->field($model, 'is_registon') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
