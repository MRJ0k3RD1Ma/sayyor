<?php

use common\models\DiseaseCategory;
use common\models\DiseaseGroups;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Diseases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diseases-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'vet4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map(DiseaseCategory::find()->asArray()->all(),'id','name_uz')
    ) ?>

    <?= $form->field($model, 'group_id')->dropDownList(
            ArrayHelper::map(DiseaseGroups::find()->asArray()->all(), 'id', 'name_uz')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.diseases', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
