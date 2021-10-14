<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MinestoryType */

$this->title = 'Янгилаш: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Орган турлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Янгилаш';
?>
<div class="minestory-type-update">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>


</div>
