<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Managment */

$this->title = 'Вилоят бошқарув органи кўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Вилоят Бошқарув органлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="managment-create">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
