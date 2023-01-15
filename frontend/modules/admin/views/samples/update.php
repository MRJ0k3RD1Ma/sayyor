<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Samples */

$this->title = Yii::t('cp.samples', 'Update Samples: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.samples', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.samples', 'O`zgartirish');
?>
<div class="samples-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
