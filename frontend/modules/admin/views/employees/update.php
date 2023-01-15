<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */

$this->title = Yii::t('cp', 'O\'zgartirish: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Foydalanuvchilar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'O\'zgartirish');
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