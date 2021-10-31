<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AnimalCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Animal Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header flex">
        <p>
            <?= Html::a(Yii::t('app', 'Create Animal Category'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">


                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>