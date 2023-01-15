<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Requirements */

$this->title = Yii::t('cp', 'Yangilash: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' =>Yii::t('cp', 'Oziq-ovqat ekspertizasi talablari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Yangilash');
?>
<div class="requirements-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
