<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */
/* @var $form yii\widgets\ActiveForm */
/* @var $org \common\models\EmpPosts*/
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>1]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readonly'=>1]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'readonly'=>1]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
