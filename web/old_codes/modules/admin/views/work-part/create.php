<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkPart */

$this->title = 'Бўлим қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Бўлимлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-part-create">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    </div>
</div>
