<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DiseaseCategory */

$this->title = Yii::t('cp.disease_category', 'Kasallik toifasi qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.disease_category', 'Kasallik toifalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disease-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
