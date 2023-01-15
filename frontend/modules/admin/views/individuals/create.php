<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Individuals */

$this->title = Yii::t('cp.individuals', 'Jismoniy shaxs qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.individuals', 'Jismoniy shaxslar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individuals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
