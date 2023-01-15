<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TemplateFood */

$this->title = Yii::t('cp', 'O`zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Shablonlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'O`zgartirish');
?>
<div class="template-food-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
