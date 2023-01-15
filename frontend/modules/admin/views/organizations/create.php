<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Organizations */

$this->title = Yii::t('cp', 'Tashkilot qo\'chish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Tashkilotlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
