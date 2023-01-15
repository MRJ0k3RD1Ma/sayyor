<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SertificateApplication */

$this->title = Yii::t('cp.sertificate_application', 'Labaratoriya tekshiruvi o\'tkazish uchun ariza berish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificate_application', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificate-application-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
