<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostList */

$this->title = Yii::t('cp', 'O\'zgartirish: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Lavozimlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'O\'zgartirish');
?>
<div class="post-list-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
