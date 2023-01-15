<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LegalEntities */

$this->title = Yii::t('cp.legal_entities', 'O\'zgartirish: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.legal_entities', 'Yuridik shaxslar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'inn' => $model->inn]];
$this->params['breadcrumbs'][] = Yii::t('cp.legal_entities', 'O\'zgartirish');
?>
<div class="legal-entities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
