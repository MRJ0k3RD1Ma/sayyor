<?php

use common\models\Soato;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VetSitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.vetsites', 'Veterinariya uchastkalari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vet-sites-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_search', [
                    'model' => $searchModel,
                ]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'vet-sites-grid',
//                        'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//            'id',
//                        'code',
                        'name',
                        [
                            'attribute' => 'soato',
                            'label' => 'Hudud nomi',
                            'value' => static function ($model) {
                                $soato = $model->soato0;
                                return
                                    @Soato::find()->where(['MHOBT_cod' => $soato->res_id])->one()->name_lot
                                    . ' ' . @Soato::find()->where(['MHOBT_cod' => $soato->res_id . $soato->region_id])->one()->name_lot
                                    . ' ' . @Soato::find()->where(['MHOBT_cod' => $soato->res_id . $soato->region_id . $soato->district_id])->one()->name_lot
                                    . ' ' . @$soato->name_lot;

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