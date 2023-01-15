<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = Yii::t('cp', 'Update Message: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'O`zgartirish');
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>