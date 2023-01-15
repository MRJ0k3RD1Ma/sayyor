<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sertificates */
/* @var $animal common\models\Animals */
/* @var $sample common\models\Samples */

$this->title = Yii::t('cp.sertificates', 'Hayvon qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Dalolatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sert_id, 'url' => ['view', 'sert_id' => $model->sert_id]];
$this->params['breadcrumbs'][] = Yii::t('cp.sertificates', 'Hayvon qo\'shish');
?>
<div class="sertificates-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($sample, 'kod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sample, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sample, 'sample_type_is')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SampleTypes::find()->all(),'id','name_uz'),['prompt'=>'Namuna turini tanlang']) ?>

    <?= $form->field($sample, 'sample_box_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SampleBoxes::find()->all(),'id','name_uz'),['prompt'=>'Namuna o\'ramini tanlang']) ?>

    <?= $form->field($animal, 'name')->textInput(['maxlength' => true]) ?>
    <?php
    $lang = Yii::$app->language;
    if($lang == 'ru'){
        $res  = "ru";
    }else{
        $res = 'uz';
    }
    ?>

    <?= $form->field($animal, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Animaltype::find()->all(),'id','name_'.$res),['prompt'=>Yii::t('cp.animals','Hayvon turini tanlang')]) ?>

    <?= $form->field($animal, 'gender')->dropDownList([
        1=>Yii::t('cp.animals','Erkak'),
        0=>Yii::t('cp.animals','Urg\'ochi')
    ]) ?>

    <?= $form->field($animal, 'birthday')->textInput(['type'=>'date']) ?>

    <?php
    if(false){
    $data = [];
        foreach (\common\models\LegalEntities::find()->all() as $item){
            $data[$item->inn] = $item->inn.' - '.$item->name;
        }
    ?>
    <?= $form->field($animal, 'inn')->dropDownList($data,['prompt'=>'Tashkilotni tanlang']) ?>
    <?php  $data = [];
    foreach (\common\models\Individuals::find()->all() as $item){
        $data[$item->pnfl] = $item->pnfl.' - '.$item->name;
    }
    }
    ?>

    <?= $form->field($animal, 'adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'vet_site_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\VetSites::find()->all(),'id','name'),['prompt'=>Yii::t('cp.animals','Vet uchastkani tanlang')]) ?>

    <?= $form->field($animal, 'bsual_tag')->textInput(['maxlength' => true]) ?>


    <?= $form->field($sample, 'test_mehod_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TestMethod::find()->all(),'id','name_uz'),['prompt'=>'Tahlil usulini tanlang']) ?>

    <?= $form->field($sample, 'suspected_disease_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Diseases::find()->all(),'id','name_uz'),['prompt'=>'Kasallik turini tanlang']) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.sertificates', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
