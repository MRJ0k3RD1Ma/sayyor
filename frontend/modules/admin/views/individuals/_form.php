<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Individuals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individuals-form">
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
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pnfl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>

    <?php if($model->soato_id){
        $model->region  = $model->soato->region_id;
        $model->district = $model->soato->district_id;
        ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->soato->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\QfiView::find()->where(['district_id'=>$model->soato->district_id])->all(),'MHOBT_cod','name_'.$ads),['prompt'=>Yii::t('cp.individuals','QFYni tanlang')]) ?>
    <?php }else{ ?>
        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

        <?= $form->field($model, 'district')->dropDownList([],['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>
        <?= $form->field($model, 'soato_id')->dropDownList([],['prompt'=>Yii::t('cp.individuals','QFYni tanlang')]) ?>
    <?php }?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.individuals', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
$url_district = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/cp/vet-sites/get-qfi']);
$this->registerJs("
        $('#individuals-region').change(function(){
            $.get('{$url_district}?id='+$('#individuals-region').val()).done(function(data){
                $('#individuals-district').empty();
                $('#individuals-district').append(data);
            })        
        })
        $('#individuals-district').change(function(){
            $.get('{$url_qfi}?id='+$('#individuals-district').val()).done(function(data){
                $('#individuals-soato').empty();
                $('#individuals-soato').append(data);
            })        
        })
    ")
?>