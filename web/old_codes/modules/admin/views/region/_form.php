<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php $data = [];

        $country = \app\models\Country::find()->all();
        foreach ($country as $item){
            $data[$item->id]=$item->code.' '.$item->name;
        }
    ?>

    <?= $form->field($model, 'country_id')->dropDownList($data,[
        'class'=>'form-control select2_list'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сақлаш' : 'Сақлаш', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
