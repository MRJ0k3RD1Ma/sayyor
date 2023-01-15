<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LaboratoryTestType */

$this->title = Yii::t('cp.laboratory_test_type', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.laboratory_test_type', 'Laboratoriya tadqiqot turlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.laboratory_test_type', 'O\'zgartirish');
?>
<div class="laboratory-test-type-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
