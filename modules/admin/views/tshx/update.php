<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tshx */

$this->title = Yii::t('cp.tshx', 'Update Tshx: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.tshx', 'Tshxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.tshx', 'Update');
?>
<div class="tshx-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
