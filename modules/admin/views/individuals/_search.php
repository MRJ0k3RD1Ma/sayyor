<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\IndividualsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individuals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pnfl') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'middlename') ?>

    <?= $form->field($model, 'soato_id') ?>

    <?php // echo $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'passport') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.individuals', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.individuals', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
