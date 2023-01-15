<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SamplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.samples', 'Namunalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="samples-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_search', [
                    'model' => $searchModel,
                ]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'samples-grid',
//        'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//            'id',
                        'kod',
                        'label',
                        'sample_type_is',
                        'sample_box_id',
                        //'animal_id',
                        //'sert_id',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]) ?>
                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>
