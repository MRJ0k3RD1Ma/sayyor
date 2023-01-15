<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TemplateFoodSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-food-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'food_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'name_ru') ?>

    <?php // echo $form->field($model, 'name_uz') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'min_1') ?>

    <?php // echo $form->field($model, 'min_2') ?>

    <?php // echo $form->field($model, 'max_1') ?>

    <?php // echo $form->field($model, 'max_2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
