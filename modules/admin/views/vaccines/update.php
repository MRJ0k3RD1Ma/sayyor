<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vaccines */

$this->title = Yii::t('cp.vaccines', 'O\'zgartirish: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.vaccines', 'Vaksinalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.vaccines', 'O\'zgartirish');
?>
<div class="vaccines-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
