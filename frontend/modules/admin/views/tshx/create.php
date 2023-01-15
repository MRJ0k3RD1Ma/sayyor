<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tshx */

$this->title = Yii::t('cp.tshx', 'Create Tshx');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.tshx', 'Tshxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tshx-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
