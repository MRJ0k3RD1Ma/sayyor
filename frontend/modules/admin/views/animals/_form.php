<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Animals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
        $lang = Yii::$app->language;
        if($lang == 'ru'){
            $res  = "ru";
        }else{
            $res = 'uz';
        }
    ?>
    <?php $form->field($model, 'cat_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\AnimalCategory::find()->all(),'id','name_'.$res),['prompt'=>Yii::t('cp.animals','Hayvon toifasini tanlang')]) ?>
    <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Animaltype::find()->all(),'id','name_'.$res),['prompt'=>Yii::t('cp.animals','Hayvon turini tanlang')]) ?>

    <?= $form->field($model, 'gender')->dropDownList([
            1=>Yii::t('cp.animals','Erkak'),
            0=>Yii::t('cp.animals','Urg\'ochi')
    ]) ?>

    <?= $form->field($model, 'birthday')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pnfl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vet_site_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\VetSites::find()->all(),'id','name'),['prompt'=>Yii::t('cp.animals','Vet uchastkani tanlang')]) ?>

    <?= $form->field($model, 'bsual_tag')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.animals', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
