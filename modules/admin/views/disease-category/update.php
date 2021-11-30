<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DiseaseCategory */

$this->title = Yii::t('cp.disease_category', 'Update Disease Category: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.disease_category', 'Disease Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.disease_category', 'Update');
?>
<div class="disease-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
