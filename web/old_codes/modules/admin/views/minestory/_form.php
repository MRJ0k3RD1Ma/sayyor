<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Minestory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="minestory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'minestory_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\MinestoryType::find()->all(),'id','name'),[
            'prompt'=>'Бошқарув органи тури...'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сақлаш' : 'Сақлаш', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
