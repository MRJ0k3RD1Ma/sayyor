<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.sertificates', 'Dalolatnomalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificates-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'sertificates-grid',
                    'summary' => '',
//                        'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                            'sert_id',
                        /*[
                            'attribute'=>'sert_id',
                            'format'=>'raw',
                            'value'=>function($d){
                                $url = Yii::$app->urlManager->createUrl(['/cp/sertificates/view','sert_id'=>$d->sert_id]);
                                return "<a href='{$url}'>{$d->sert_id}</a>";
                            },
                        ],*/
                        'sert_num',
                        'sert_date',
//                            'organization_id',
                        'pnfl',
                        'owner_name',
                        //'vet_site_id',
                        //'operator',

                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>


