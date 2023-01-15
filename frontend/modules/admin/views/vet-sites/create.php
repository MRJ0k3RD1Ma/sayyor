<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VetSites */

$this->title = Yii::t('cp.vetsites', 'Vet uchaska qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.vetsites', 'Vet uchastkalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vet-sites-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
