<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Samples */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="samples-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sample_type_is')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SampleTypes::find()->all(),'id','name_uz'),['prompt'=>'namuna turini tanlang']) ?>

    <?= $form->field($model, 'sample_box_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SampleBoxes::find()->all(),'id','name_uz'),['prompt'=>'namuna guruhini tanlang']) ?>

    <?= $form->field($model, 'animal_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Animals::find()->all(),'id','name'),['prompt'=>'hayvonni tanlang']) ?>

    <?= $form->field($model, 'sert_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Sertificates::find()->all(),'sert_id','sert_id'),['prompt'=>'Dalolatnomani tanlang']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.samples', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
