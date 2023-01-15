<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SertificateApplication */

$this->title = Yii::t('cp.sertificate_application', 'O\'zgartirish: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificate_application', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.sertificate_application', 'O\'zgartirish');
?>
<div class="sertificate-application-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
