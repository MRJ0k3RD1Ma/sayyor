<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'def_role')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Roles::find()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
