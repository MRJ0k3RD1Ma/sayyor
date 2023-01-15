<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SampleRegistration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-registration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pnfl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_research')->textInput() ?>

    <?= $form->field($model, 'code_id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'research_category_id')->textInput() ?>

    <?= $form->field($model, 'results_conformity_id')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'emp_id')->textInput() ?>

    <?= $form->field($model, 'reg_date')->textInput() ?>

    <?= $form->field($model, 'reg_id')->textInput() ?>

    <?= $form->field($model, 'sender_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sender_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'ads')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'res')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res_id')->textInput() ?>

    <?= $form->field($model, 'registon_id')->textInput() ?>

    <?= $form->field($model, 'is_registon')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
