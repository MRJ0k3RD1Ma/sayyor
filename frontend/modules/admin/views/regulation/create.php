<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Regulations */

$this->title = Yii::t('app', 'Normativ hujjatlar qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Normativ hujjatlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regulations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
