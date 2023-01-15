<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VetSites */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vet-sites-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
        $lang = Yii::$app->language;
        if($lang == 'ru'){
            $ads = 'ru';
        }elseif($lang=='oz'){
            $ads = 'cyr';
        }else{
            $ads = 'lot';
        }
    ?>

    <?php if($model->soato){
        $model->region  = $model->soato0->region_id;
        $model->district = $model->soato0->district_id;
        ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->soato0->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\QfiView::find()->where(['district_id'=>$model->soato0->district_id])->all(),'MHOBT_cod','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','QFYni tanlang')]) ?>
    <?php }else{ ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','QFYni tanlang')]) ?>
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.vetsites', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
    $url_district = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-district']);
    $url_qfi = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-qfi']);
    $this->registerJs("
        $('#vetsites-region').change(function(){
            $.get('{$url_district}?id='+$('#vetsites-region').val()).done(function(data){
                $('#vetsites-district').empty();
                $('#vetsites-district').append(data);
            })        
        })
        $('#vetsites-district').change(function(){
            $.get('{$url_qfi}?id='+$('#vetsites-district').val()+'&regid='+$('#vetsites-region').val()).done(function(data){
                $('#vetsites-soato').empty();
                $('#vetsites-soato').append(data);
            })        
        })
    ")
?>