<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */
/* @var $form yii\widgets\ActiveForm */
/* @var $org \common\models\EmpPosts*/
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord){?>
        <?= $form->field($org,'org_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Organizations::find()->all(),'id','NAME_FULL'))?>

        <?= $form->field($org,'gov_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Goverments::find()->all(),'id','name_uz'))?>

        <?= $form->field($org,'post_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PostList::find()->all(),'id','name'),['prompt'=>Yii::t('cp','Lavozimni tanlang')])?>
    <?php }?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
