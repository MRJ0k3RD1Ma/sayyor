<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VetSites */

$this->title = Yii::t('cp.vetsites', 'Update Vet Sites: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.vetsites', 'Vet Sites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.vetsites', 'Update');
?>
<div class="vet-sites-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
