<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AnimalCategory */

$this->title = Yii::t('cp', 'Hayvon toifasi qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Hayvon toifalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
