<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrganizationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Tashkilot turlari');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header flex">
        <div></div>
        <div class="btns flex">
            <div class="search">

                <?php $form = \yii\widgets\ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false,],],'method'=>'get'])?>
                    <?= $form->field($searchModel,'name',['template' => "{label}\n{input}"])->textInput(['class'=>''])->label(false)?>
                    <button class="btn" type="submit"><span class="fa fa-search"></span></button>
                <?php \yii\widgets\ActiveForm::end()?>

            </div>
            <div class="export">

                <button class="btn btn-primary "> <span class="fa fa-cloud-download-alt"></span> <?= Yii::t('cp','Export')?></button>
                <div class="export-btn">
                    <button value="excel" class="export"><span class="fa fa-file-excel"></span>  <?= Yii::t('cp','Excel')?></button>
                    <button value="excel" class="export"><span class="fa fa-file-pdf"></span>  <?= Yii::t('cp','Pdf')?></button>
                </div>
            </div>

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

                    ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
                ],
            ]); ?>
        </div>
    </div>
    <!-- end card body -->
</div>

<?php

    $excel =  \yii\helpers\Url::current(['export'=>'excel']);
    $pdf =  \yii\helpers\Url::current(['export'=>'pdf']);

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