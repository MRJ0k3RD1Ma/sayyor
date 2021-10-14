<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'share')->dropDownList([
            0=>'Администратор',
            1=>'Супер Администратор'
        ]) ?>

    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pin_code')->textInput(['type'=>'number']) ?>

        <?= $form->field($model, 'status')->dropDownList([0=>'Актив',1=>'Деактив']) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Сақлаш' : 'Сақлаш', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style'=>'margin-top:23px;']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
