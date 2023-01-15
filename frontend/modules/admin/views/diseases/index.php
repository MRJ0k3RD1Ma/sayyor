<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DiseasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.diseases', 'Kasalliklar ro`yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diseases-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_search', [
                    'model' => $searchModel,
                ]);
                ?>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'disease-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',
                            'vet4',
//                            'category_id',
//                            'group_id',
                            [
                                'attribute'=>'category_id',
                                'value'=>function($d){
                                    $lang = Yii::$app->language;
                                    if($lang == 'ru'){
                                        return $d->category->name_ru;
                                    }else{
                                        return $d->category->name_uz;
                                    }
                                }
                            ],
                            [
                                'attribute'=>'group_id',
                                'value'=>function($d){
                                    $lang = Yii::$app->language;
                                    if($lang === 'ru'){
                                        return $d->group->name_ru;
                                    }

                                    return $d->group->name_uz;
                                }
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]) ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>




</div>
