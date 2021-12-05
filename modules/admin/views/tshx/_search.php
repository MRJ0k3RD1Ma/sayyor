<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TshxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tshx-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_uz') ?>

    <?= $form->field($model, 'name_ru') ?>

    <?= $form->field($model, 'code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.tshx', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.tshx', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
