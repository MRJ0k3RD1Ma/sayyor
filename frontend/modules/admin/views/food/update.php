<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Food */

$this->title = 'O\'zgartirish: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Oziq-ovqatlar guruhlari ro\'yhati', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'O\'zgartirish';
?>
<div class="food-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
