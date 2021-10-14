<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Complex */

$this->title = 'Комплекс қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Кўмплекслар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complex-create">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
