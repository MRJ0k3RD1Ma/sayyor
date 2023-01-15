<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$data=file_get_contents('js/main.js');
$this->registerJs($data);
$this->title = Yii::t('cp.sertificates', 'Hayvon kasalliklari arizalar ro\'yxati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificates-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <?php echo $this->render('_searchsert', [
                        'model' => $searchModel,
                    ]);
                    ?>
                    <div class="submit_vote">
                    <?php
                    \yii\bootstrap4\Modal::begin([
                        'size' => 'modal-lg',
                        'options' => [
                            'id' => 'custModal',
                        ],
                        'footer' => '@QalandarDev'
                    ]);


                    echo \yii\helpers\Html::submitButton(
                        '<span class="glyphicon glyphicon-search"></span>',
                        [
                            'class' => 'btn btn-success',
                        ]
                    );
                    \yii\bootstrap4\Modal::end();
                    ?>
                    </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'listsert-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
//                            'code',
                            [
                                'attribute'=>'code',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/komitet/viewsert','id'=>$d->id]);
                                    return "<a href='{$url}'>{$d->code}</a>";
                                },
                                'filter'=>false,
                                'format'=>'raw'
                            ],
                            [
                                'label' => Yii::t('client', 'Namuna raqamlari'),
                                'value' => function ($d) {

                                    $res = $out="";
                                    foreach ($d->comp as $item) {
                                        $res = $d->status->icon . $item->sample->kod ;
                                        $out.=\yii\helpers\Html::button(
                                            $res,
                                            ['value' => \yii\helpers\Url::to(['viewnamuna','id'=>$item->sample->id]),
                                                'class' => 'btn showModalButton',
                                                'data-id'=>$item->sample->id,
                                                'title' => 'Batafsil',
                                                'data-pjax' => 0
                                            ]);
                                    }
                                    return $out;
                                },
                                'format' => 'raw',
                            ],
                            [
                                'label' => Yii::t('register', 'Labaratoriya'),
                                'value' => function ($d) {
                                    return $d->organization->NAME_FULL;
                                },
                                'format' => 'raw'
                            ],
                            [
                                'label' => 'Manzil',
                                'format'=>'html',
                                'value' => function ($d) {
                                    foreach ($d->comp as $item) {
                                        $vet = $item->sample->sert->vetSite;
                                        return \common\models\Soato::Full($vet->soato);
                                    }
                                }
                            ],
//                            'is_research',
                            [
                                'attribute' => 'is_research',
                                'value' => function ($d) {
                                    $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                                    return $s[$d->is_research];
                                }
                            ],
//                            'code_id',
                            //'code',
                            //'research_category_id',
                            [
                                'attribute'=>'research_category_id',
                                'value'=>function($d){
                                    return $d->researchCategory->name_uz;
                                }
                            ],
                            //'results_conformity_id',
                            //'organization_id',
                            //'emp_id',
//                            'reg_date',
                            //'reg_id',
                            'sender_name',
                            'sender_phone',
                            'created',
                            //'updated',
                        ],
                    ]); ?>
                    <?php
                        \yii\widgets\Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {

            $('.showModalButton').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    url: 'viewnamuna?id='+id,
                    type: 'get',
                    success: function (response) {
                        $('.modal-body').html(response);
                        $('#custModal').modal('show');
                    }
                });
            });

        });
    </script>
</div>
