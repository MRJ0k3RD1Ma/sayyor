<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Goverments $model */

$this->title = 'O`zgartirish: ' . $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => 'Bo`limlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_uz, 'url' => ['view', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru]];
$this->params['breadcrumbs'][] = 'O`zgartirish';
?>
<div class="goverments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
