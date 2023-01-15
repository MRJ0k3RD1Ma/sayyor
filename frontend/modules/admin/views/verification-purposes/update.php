<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VerificationPurposes */

$this->title = Yii::t('cp.verification_purposes', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.verification_purposes', 'Tekshirish maqsadlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.verification_purposes', 'O\'zgartirish');
?>
<div class="verification-purposes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
