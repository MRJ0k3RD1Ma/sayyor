<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<p>Administrator mavjud emas. <br> Administrator qo'shish.</p>

    <?php $model->scenario = 'insert';?>

    <?php $form = ActiveForm::begin([
        'action'=>'/admin/default/create',
        'options'=>[
            'class'=>'m-t'
        ],
    ]); ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <div class="row">
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
    </div>

    <?php ActiveForm::end(); ?>
