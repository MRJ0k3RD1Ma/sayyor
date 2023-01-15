<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Samples */

$this->title = Yii::t('cp.samples', 'Create Samples');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.samples', 'Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="samples-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
