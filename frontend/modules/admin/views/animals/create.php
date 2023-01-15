<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Animals */

$this->title = Yii::t('cp.animals', 'Hayvon qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.animals', 'Hayvonlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
