<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DiseaseGroups */

$this->title = Yii::t('cp.disease_groups', 'Update Disease Groups: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.disease_groups', 'Disease Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.disease_groups', 'Update');
?>
<div class="disease-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
