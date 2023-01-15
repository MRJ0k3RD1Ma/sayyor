<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TamplateAnimalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tamplate-animal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'diseases_id') ?>

    <?php // echo $form->field($model, 'test_method_id') ?>

    <?php // echo $form->field($model, 'name_uz') ?>

    <?php // echo $form->field($model, 'name_ru') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'min') ?>

    <?php // echo $form->field($model, 'min_1') ?>

    <?php // echo $form->field($model, 'max') ?>

    <?php // echo $form->field($model, 'max_1') ?>

    <?php // echo $form->field($model, 'is_vaccination') ?>

    <?php // echo $form->field($model, 'dead_days') ?>

    <?php // echo $form->field($model, 'creator_id') ?>

    <?php // echo $form->field($model, 'consent_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'state_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
