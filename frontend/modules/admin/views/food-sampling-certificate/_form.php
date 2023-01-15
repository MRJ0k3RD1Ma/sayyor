<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSamplingCertificate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-sampling-certificate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pnfl')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Individuals::find()->all(),'pnfl','name'),['prompt'=>'PNFLni tanlang']) ?>

    <?= $form->field($model, 'organization_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Organizations::find()->all(),'id','NAME_FULL'),['prompt'=>'Tashkilotni tanlang']) ?>

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

    <?php if($model->sampling_site){

        $model->region  = $model->samplingSite->soato0->region_id;
        $model->district = $model->samplingSite->soato0->district_id;

        ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->samplingSite->soato0->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\QfiView::find()->where(['district_id'=>$model->samplingSite->soato0->district_id])->all(),'MHOBT_cod','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','QFYni tanlang')]) ?>
        <?= $form->field($model, 'sampling_site')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\VetSites::find()->where(['soato'=>$model->samplingSite->soato0->qfi_id])->all(),'id','name'),['prompt'=>Yii::t('cp.vetsites','Vet uchstkani tanlang')]) ?>

    <?php }else{ ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','QFYni tanlang')]) ?>
        <?= $form->field($model, 'sampling_site')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','Vet uchstkani tanlang')]) ?>

    <?php }?>

    <?= $form->field($model, 'sampling_adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sampler_organization_code')->textInput() ?>

    <?= $form->field($model, 'sampler_person_pnfl')->textInput() ?>

    <?= $form->field($model, 'unit_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Units::find()->all(),'id','name_uz'),['prompt'=>'Birlikni tanlang']) ?>

    <?= $form->field($model, 'count')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'verification_sample')->dropDownList([1=>'Ha',0=>'Yo\'q']) ?>

    <?= $form->field($model, 'producer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacture_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'sell_by')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'coments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verification_pupose_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\VerificationPurposes::find()->all(),'id','name_uz'),['prompt'=>'Tekshirishdan maqsadni tanlang']) ?>

    <?= $form->field($model, 'sample_box_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SampleBoxes::find()->all(),'id','name_uz'),['prompt'=>'Namuna o\'ramini tanlang']) ?>

    <?= $form->field($model, 'sample_condition_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SampleConditions::find()->all(),'id','name_uz'),['prompt'=>'Namuna holati']) ?>

    <?= $form->field($model, 'sampling_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'send_sample_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'explanations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'based_public_information')->dropDownList([0=>'Yo\'q',1=>'Ha']) ?>

    <?= $form->field($model, 'message_number')->textInput() ?>

    <?= $form->field($model, 'laboratory_test_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LaboratoryTestType::find()->all(),'id','name_uz'),['prompt'=>'Laboratoriya tadqiqot turini tanlang']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.food_sampling_certificate', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url_district = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-qfi']);
$url_vetsites = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-vetsites']);
$this->registerJs("
        $('#foodsamplingcertificate-region').change(function(){
            $.get('{$url_district}?id='+$('#foodsamplingcertificate-region').val()).done(function(data){
                $('#foodsamplingcertificate-district').empty();
                $('#foodsamplingcertificate-district').append(data);
            })        
        })
        $('#foodsamplingcertificate-district').change(function(){
            $.get('{$url_qfi}?id='+$('#foodsamplingcertificate-district').val()).done(function(data){
                $('#foodsamplingcertificate-soato').empty();
                $('#foodsamplingcertificate-soato').append(data);
            })        
        })
        
         $('#foodsamplingcertificate-soato').change(function(){
            $.get('{$url_vetsites}?id='+$('#foodsamplingcertificate-soato').val()).done(function(data){
                $('#foodsamplingcertificate-sampling_site').empty();
                $('#foodsamplingcertificate-sampling_site').append(data);
            })        
        })
    ")
?>