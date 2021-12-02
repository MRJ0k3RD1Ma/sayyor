<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Soato */

$this->title = Yii::t('cp', 'Update Soato: {name}', [
    'name' => $model->MHOBT_cod,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Soatos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MHOBT_cod, 'url' => ['view', 'MHOBT_cod' => $model->MHOBT_cod]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'Update');
?>
<div class="soato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
