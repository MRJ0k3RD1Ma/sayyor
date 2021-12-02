<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\AnimalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'inn') ?>

    <?php // echo $form->field($model, 'pnfl') ?>

    <?php // echo $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'vet_site_id') ?>

    <?php // echo $form->field($model, 'bsual_tag') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.animals', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp.animals', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
