<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TemplateUnit */

$this->title = Yii::t('app', 'Shablon birliklari: {name}', [
    'name' => $model->name_uz,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shablon birliklari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_uz, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Yangilash');
?>
<div class="template-unit-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
