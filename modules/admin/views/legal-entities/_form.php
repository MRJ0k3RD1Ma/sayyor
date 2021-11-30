<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LegalEntities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="legal-entities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tshx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'soogu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'soato')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.legal_entities', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
