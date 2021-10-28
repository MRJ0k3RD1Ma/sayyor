<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\StateList::find()->all(),'id','name')) ?>

    <?= $form->field($model,'reg')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Regions::find()->all(),'id','name'),['prompt'=>Yii::t('cp','Viloyatni tanlang')])?>

    <?= $form->field($model, 'district_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Districts::find()->where(['region_id'=>$model->reg])->all(),'id','name'),['prompt'=>Yii::t('cp','Tumanni tanglang')]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\OrganizationType::find()->all(),'id','name')) ?>

    <h3 class="card-title">
        <?= Yii::t('cp','Yuqori turuvchi tashkilot')?>
    </h3>
    <?= $form->field($model,'yuqori_reg')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Regions::find()->all(),'id','name'),['prompt'=>Yii::t('cp','Viloyatni tanlang')])?>

    <?= $form->field($model, 'yuqori_dist')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Districts::find()->where(['region_id'=>$model->yuqori_reg])->all(),'id','name'),['prompt'=>Yii::t('cp','Tumanni tanglang')]) ?>

    <?= $form->field($model, 'yuqori_type')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\OrganizationType::find()->all(),'id','name'),['prompt'=>Yii::t('cp','Yuqori turuvchi tashkilot turini tanlang')]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Organizations::find()->where(['district_id'=>$model->yuqori_dist,'type_id'=>$model->yuqori_type])->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $url = Yii::$app->urlManager->createUrl(['/cp/districts/getselect']);
    $url_org = Yii::$app->urlManager->createUrl(['/cp/organizations/getselect']);
    $this->registerJs("
        $('#organizations-reg').change(function(){
            $.get('{$url}?id='+$('#organizations-reg').val()).done(function(data){
                $('#organizations-district_id').empty();
                $('#organizations-district_id').append(data);
            })
        });
        $('#organizations-yuqori_reg').change(function(){
            $.get('{$url}?id='+$('#organizations-yuqori_reg').val()).done(function(data){
                $('#organizations-yuqori_dist').empty();
                $('#organizations-yuqori_dist').append(data);
            })
        })
         $('#organizations-yuqori_dist').change(function(){
            $.get('{$url_org}?dist='+$('#organizations-yuqori_dist').val()+'&type='+$('#organizations-yuqori_type').val()).done(function(data){
                $('#organizations-parent_id').empty();
                $('#organizations-parent_id').append(data);
            })
         });
         $('#organizations-yuqori_type').change(function(){
            $.get('{$url_org}?dist='+$('#organizations-yuqori_dist').val()+'&type='+$('#organizations-yuqori_type').val()).done(function(data){
                $('#organizations-parent_id').empty();
                $('#organizations-parent_id').append(data);
            })
         })
    ")
?>