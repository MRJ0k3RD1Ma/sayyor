<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodGroup */

$this->title = Yii::t('cp', 'O`zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Oziq-ovqat Parametr guruhlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'O\'zgartirish');
?>
<div class="food-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
