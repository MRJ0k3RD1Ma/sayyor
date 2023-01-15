<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DiseaseGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.disease_groups', 'Kasallik guruhlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disease-groups-index">
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
                         'id' => 'disease-groups-grid',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]) ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>


</div>
