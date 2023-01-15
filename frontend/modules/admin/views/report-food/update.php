<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReportFoodCategory */

$this->title = Yii::t('app', 'Update Report Food Category: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Food Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'O`zgartirish');
?>
<div class="report-food-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
