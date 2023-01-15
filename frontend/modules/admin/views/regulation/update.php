<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Regulations */

$this->title = Yii::t('app', 'Normativ hujjatlar tahrirlash: {name}', [
    'name' => $model->name_uz,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Normativ hujjatlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_uz, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="regulations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
