<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diseases */

$this->title = Yii::t('cp.diseases', 'Kasallik qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.diseases', 'Kasalliklar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diseases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
