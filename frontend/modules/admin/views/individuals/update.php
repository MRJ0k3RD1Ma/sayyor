<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Individuals */

$this->title = Yii::t('cp.individuals', 'O\'zgartirish: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.individuals', 'Jismoniy shaxslar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'pnfl' => $model->pnfl]];
$this->params['breadcrumbs'][] = Yii::t('cp.individuals', 'O\'zgartirish');
?>
<div class="individuals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
