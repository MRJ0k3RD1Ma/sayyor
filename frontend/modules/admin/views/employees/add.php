<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmpPosts */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('cp', 'Lavozim qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Foydalanuvchilar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp->name, 'url' => ['view','id'=>$model->emp_id]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

                <?php $form = ActiveForm::begin(); ?>
                <?php
                    $lg = 'uz';
                    if(Yii::$app->language == 'ru'){
                        $lg = 'ru';
                    }
                ?>
                <?= $form->field($model,'gov_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Goverments::find()->all(),'id','name_'.$lg),['prompt'=>Yii::t('cp','Lavozimni tanlang')])?>

                <?= $form->field($model,'post_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PostList::find()->all(),'id','name'),['prompt'=>Yii::t('cp','Lavozimni tanlang')])?>

                <?= $form->field($model,'date')->textInput(['type'=>'date'])?>

                <?= $form->field($model,'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\StatusList::find()->all(),'id','name'),['prompt'=>Yii::t('cp','Status')])?>

                <?php if($model->emp_id){?>
                    <?= $form->field($model,'org_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Organizations::find()->all(),'id','NAME_FULL'),['disabled'=>true,'prompt'=>Yii::t('cp','Tashkilot nomi')])?>
                <?php }else{?>
                    <?= $form->field($model,'org_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Organizations::find()->all(),'id','NAME_FULL'),['prompt'=>Yii::t('cp','Tashkilot nomi')])?>
                <?php }?>



                <div class="form-group">
                    <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>