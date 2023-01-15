<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SampleConditions */

$this->title = Yii::t('cp.sample_conditions', 'Namuna holati qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sample_conditions', 'Namuna holatlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-conditions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
