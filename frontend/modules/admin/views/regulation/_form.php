<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Regulations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regulations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::class,
        [
            'name' => 'file',
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ]) ?>
    <?php $lg = 'uz'; if(Yii::$app->language == 'ru')$lg='ru';?>
    <?= $form->field($model,'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegulationTypes::find()->all(),'id','name_'.$lg))?>

    <?= $form->field($model, 'creator_id')->hiddenInput(['value' => Yii::$app->user->identity->getId()])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
