<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\District */

$this->title = 'Янгилаш: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Туманлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Янгилаш';
?>
<div class="district-update">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
