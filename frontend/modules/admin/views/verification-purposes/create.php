<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VerificationPurposes */

$this->title = Yii::t('cp.verification_purposes', 'Tekshirish maqsadi qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.verification_purposes', 'Tekshirish maqsadlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verification-purposes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
