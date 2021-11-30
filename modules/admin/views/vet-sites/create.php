<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VetSites */

$this->title = Yii::t('cp.vetsites', 'Create Vet Sites');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.vetsites', 'Vet Sites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vet-sites-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
