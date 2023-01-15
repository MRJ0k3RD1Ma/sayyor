<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TestMethod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-method-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\StatusList::find()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.test_method', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
