<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Goverments $model */

$this->title = 'Bo`lim qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Bo`limlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goverments-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
