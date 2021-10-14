<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = 'Профил: ' . $model->name;
$this->params['breadcrumbs'][] = 'Янгилаш';
?>
<div class="admin-update">

    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('/admin/_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
