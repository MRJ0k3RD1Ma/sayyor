<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SampleConditions */

$this->title = Yii::t('cp.sample_conditions', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sample_conditions', 'Namuna holatlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.sample_conditions', 'O\'zgartirish');
?>
<div class="sample-conditions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
