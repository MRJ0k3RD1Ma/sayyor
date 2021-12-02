<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\OrganizationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_from_api') ?>

    <?= $form->field($model, 'TIN') ?>

    <?= $form->field($model, 'NA1_CODE') ?>

    <?= $form->field($model, 'NS10_CODE') ?>

    <?php // echo $form->field($model, 'NS11_CODE') ?>

    <?php // echo $form->field($model, 'NAME_FULL') ?>

    <?php // echo $form->field($model, 'ADDRESS') ?>

    <?php // echo $form->field($model, 'REG_DATE') ?>

    <?php // echo $form->field($model, 'DATE_TIN') ?>

    <?php // echo $form->field($model, 'REG_NUM') ?>

    <?php // echo $form->field($model, 'NS13_CODE') ?>

    <?php // echo $form->field($model, 'TELEFON') ?>

    <?php // echo $form->field($model, 'TELEX') ?>

    <?php // echo $form->field($model, 'FAX') ?>

    <?php // echo $form->field($model, 'GD_FULL_NAME') ?>

    <?php // echo $form->field($model, 'GD_TIN') ?>

    <?php // echo $form->field($model, 'GD_TEL_WORK') ?>

    <?php // echo $form->field($model, 'GD_TEL_HOME')->checkbox() ?>

    <?php // echo $form->field($model, 'GD_EMAIL') ?>

    <?php // echo $form->field($model, 'GB_FULL_NAME') ?>

    <?php // echo $form->field($model, 'GB_TIN') ?>

    <?php // echo $form->field($model, 'GB_TEL_WORK') ?>

    <?php // echo $form->field($model, 'GB_TEL_HOME') ?>

    <?php // echo $form->field($model, 'OKED') ?>

    <?php // echo $form->field($model, 'OKPO') ?>

    <?php // echo $form->field($model, 'OKONX') ?>

    <?php // echo $form->field($model, 'soato') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'DATE_END') ?>

    <?php // echo $form->field($model, 'CREATED') ?>

    <?php // echo $form->field($model, 'CHANGED') ?>

    <?php // echo $form->field($model, 'GD_MOBILE') ?>

    <?php // echo $form->field($model, 'BUDJET')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cp', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
