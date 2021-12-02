<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sertificates */

$this->title = Yii::t('cp.sertificates', 'Update Sertificates: {name}', [
    'name' => $model->sert_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Sertificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sert_id, 'url' => ['view', 'sert_id' => $model->sert_id]];
$this->params['breadcrumbs'][] = Yii::t('cp.sertificates', 'Update');
?>
<div class="sertificates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
