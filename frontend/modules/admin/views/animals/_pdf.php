<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AnimalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.animals', 'Hayvonlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <!--                    --><?php //echo $this->render('_search', [
                    //                        'model' => $searchModel,
                    //                    ]);
                    ?>
                    <div class="card-body">


                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'id' => 'animals-grid',
                            'summary' => '',
//        'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

//            'id',
                                'name',
//            'cat_id',
//            'gender',
                                'birthday',
                                'inn',
                                'pnfl',
                                'adress',
                                //'vet_site_id',
                                //'bsual_tag',
                                //'type_id',
                            ],
                        ]) ?>
                    </div>
                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
    </div>
