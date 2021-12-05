<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LegalEntities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="legal-entities-form">
    <?php
    $lang = Yii::$app->language;
    if($lang == 'ru'){
        $ads = 'ru';
        $lg = 'ru';
    }elseif($lang=='oz'){
        $ads = 'cyr';
        $lg = 'uz';
    }else{
        $ads = 'lot';
        $lg = 'uz';
    }
    ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tshx')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Tshx::find()->all(),'id','name_'.$lg),['prompt'=>Yii::t('cp.legal_entities','Tashkiliy huquqiy shaklni tanlang')]) ?>

    <?= $form->field($model, 'soogu')->textInput(['maxlength' => true]) ?>

    <?php if($model->soato){
        $model->region  = $model->soato0->region_id;
        $model->district = $model->soato0->district_id;
        ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\DistrictView::find()->where(['region_id'=>$model->soato0->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.legal_entities','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\QfiView::find()->where(['district_id'=>$model->soato0->district_id])->all(),'MHOBT_cod','name_'.$ads),['prompt'=>Yii::t('cp.legal_entities','QFYni tanlang')]) ?>
    <?php }else{ ?>

        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.legal_entities','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList([],['prompt'=>Yii::t('cp.legal_entities','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato')->dropDownList([],['prompt'=>Yii::t('cp.legal_entities','QFYni tanlang')]) ?>

    <?php }?>

    <?= $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\StatusList::find()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.legal_entities', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$url_district = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-qfi']);
$this->registerJs("
        $('#legalentities-region').change(function(){
            $.get('{$url_district}?id='+$('#legalentities-region').val()).done(function(data){
                $('#legalentities-district').empty();
                $('#legalentities-district').append(data);
            })        
        })
        $('#legalentities-district').change(function(){
            $.get('{$url_qfi}?id='+$('#legalentities-district').val()).done(function(data){
                $('#legalentities-soato').empty();
                $('#legalentities-soato').append(data);
            })        
        })
    ")
?>