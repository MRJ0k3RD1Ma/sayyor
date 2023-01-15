<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReportFood */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Oziq ovqat ekspertizalari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="report-food-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'code',
//            'rep_id',
            [
                'attribute'=>'food_id',
                'value'=>function($d){
                    $lang = Yii::$app->language;
                    $lg = 'uz';
                    if($lang == 'ru'){
                        $lg = 'ru';
                    }
                    return $d->food->{'name_'.$lg};
                }
            ],
            [
                'attribute'=>'cat_id',
                'value'=>function($d){
                    $lang = Yii::$app->language;
                    $lg = 'uz';
                    if($lang == 'ru'){
                        $lg = 'ru';
                    }
                    return $d->cat->{'name_'.$lg};
                }
            ],

//            'lat',
//            'long',
            [
                'attribute'=>'soato_id',
                'value'=>function($d){
                    $lang = Yii::$app->language;
                    $lg = 'uz';
                    if($lang == 'ru'){
                        $lg = 'ru';
                    }
                    return \common\models\Soato::Full($d->soato_id);
                }
            ],
            'phone',
            'detail:ntext',
            'created',
            'updated',
            [
                'attribute'=>'is_true',
                'value'=>function($d){
                    $s = [0=>Yii::t('district','Yo\'q'),1=>Yii::t('district','Ha'),-1=>Yii::t('district','Tekshirilmagan')];
                    return $s[$d->is_true];
                }
            ],
            [
                'attribute'=>'operator_id',
                'value'=>function($d){
                    if($d->operator_id){
                        return $d->operator->name;
                    }else{
                        return null;
                    }
                }
            ],
            [
                'attribute'=>'status_id',
                'value'=>function($d){
                    $lg=Yii::$app->language=='ru'?'ru':'uz';
                    return $d->status->{'name_'.$lg};
                }
            ],
            [
                'label' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    $img = 'http://' . Yii::$app->request->serverName . '/uploads/' . \common\models\ReportFoodImages::find()->where(['report_id' => $model->id])->one()->image;
                    echo \lo\widgets\magnific\MagnificPopup::widget(
                        [
                            'target' => '#test',
                            'options' => [
                                'delegate' => 'a',
                            ]
                        ]
                    );
                    return
                        '<a id="test" target="_blank" href="'.$img.'">'
                        .   \yii\helpers\Html::img($img, ['width' => 75, 'height' => 75])
                        . '</a>';
                }
            ],
        ],
    ]) ?>

    <div id="map"></div>

    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
    <script>

        // Attach your callback function to the `window` object
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = { lat: <?= $model->lat?>, lng: <?= $model->long?> };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }

    </script>
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAKc6n_ShV0w0BIcrtYymLAwK4UB1g0g4&callback=initMap">
    </script>


</div>