<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrganizationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Tashkilot turlari');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="card">
        <div class="card-header flex">
            <div class="btns flex">
                <?= Html::a(Yii::t('cp', 'Tashkilot turi qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>

            </div>



        </div><!-- end card header -->

        <div class="card-body">
            <div class="row">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                        'name',
                        /* [
                             'label'=>Yii::t('cp','Ташкилотлар сони'),
                             'value'=>function($d){
                                 $url = Yii::$app->urlManager->createUrl(['/cp/organizations']);
                                 $txt = Yii::t('cp','ta');
                                 return "<a href='{$url}'>{$d->count()} {$txt}</a>";
                             },
                             'format'=>'raw',
                         ],*/

//                        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                    ],
                ]); ?>
            </div>
        </div>
        <!-- end card body -->
    </div>

<?php

$excel = \yii\helpers\Url::current(['export' => 'excel']);
$pdf = \yii\helpers\Url::current(['export' => 'pdf']);

$this->registerJs("
        $('.export').click(function(){
            var type = this.value;
            if(type == 'excel'){
                $.post('$excel').done(function(data){
                    alert(data);
                });
            }
            if(type == 'pdf'){
            
            }
        })
    ")
?>