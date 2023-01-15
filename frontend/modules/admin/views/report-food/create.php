<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReportFoodCategory */

$this->title = Yii::t('app', 'Create Report Food Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Food Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-food-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
