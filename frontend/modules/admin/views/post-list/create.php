<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostList */

$this->title = Yii::t('cp', 'Lavozim qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Lavozimlar '), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-list-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
