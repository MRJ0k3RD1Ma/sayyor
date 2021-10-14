<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Minestory */

$this->title = 'Янгилаш: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Бошқарув органлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Янгилаш';
?>
<div class="minestory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
