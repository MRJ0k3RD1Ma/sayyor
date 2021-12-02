<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SamplesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="samples-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kod') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'sample_type_is') ?>

    <?= $form->field($model, 'sample_box_id') ?>

    <?php // echo $form->field($model, 'animal_id') ?>

    <?php // echo $form->field($model, 'sert_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.samples', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.samples', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
