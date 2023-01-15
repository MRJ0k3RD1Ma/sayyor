<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodRegistration */

$this->title = Yii::t('cp', 'Update Food Registration: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Food Registrations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'Update');
?>
<div class="food-registration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
