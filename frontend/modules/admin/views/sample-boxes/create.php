<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SampleBoxes */

$this->title = Yii::t('cp.sample_boxes', 'Namuna o\'rami qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sample_boxes', 'Namuna o\'ramlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-boxes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
