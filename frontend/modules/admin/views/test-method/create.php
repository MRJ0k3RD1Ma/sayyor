<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TestMethod */

$this->title = Yii::t('cp.test_method', 'Tahlil usuli qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.test_method', 'Tahlil usullari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-method-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
