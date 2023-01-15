<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Food */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
    <?php $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}?>
    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\FoodCategory::find()->all(),'id','name_'.$lg)) ?>

    <?php
        $data = [];
        $data['XX']='XX';
        foreach (\common\models\Animaltype::find()->all() as $item){
            $data[$item->vet4] = $item->vet4.' - '.$item->{'name_'.$lg};
        }
    ?>
    <?= $form->field($model, 'animal_type_id')->dropDownList($data,['prompt'=>Yii::t('cp','Aloqasiz')]) ?>

    <?= $form->field($model, 'for_all')->checkbox(['value'=>1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
