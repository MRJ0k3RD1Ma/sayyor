<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SertificateApplication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sertificate-application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pnfl')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Individuals::find()->all(),'pnfl','name')) ?>

    <?= $form->field($model, 'inn')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\LegalEntities::find()->all(),'inn','name')) ?>

    <?= $form->field($model, 'fsc_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\FoodSamplingCertificate::find()->all(),'id','kod')) ?>

    <?= $form->field($model, 'vet_site_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\VetSites::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'labaratory_test_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\LaboratoryTestType::find()->all(),'id','name_uz')) ?>

    <?= $form->field($model, 'emergency_check')->dropDownList([0=>'Yo\'q',1=>'Ha']) ?>

    <?= $form->field($model, 'cat_id')->dropDownList([0=>'Bepul',1=>'Pullik']) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'check_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'status')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\StatusList::find()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.sertificate_application', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
