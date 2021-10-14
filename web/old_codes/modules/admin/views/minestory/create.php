<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Minestory */

$this->title = 'Бошқарув органи қўшиш';
$this->params['breadcrumbs'][] = ['label' => 'Бошқарув органлари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="minestory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
