<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\LegalEntitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="legal-entities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'tshx') ?>

    <?= $form->field($model, 'soogu') ?>

    <?= $form->field($model, 'soato') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.legal_entities', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.legal_entities', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
