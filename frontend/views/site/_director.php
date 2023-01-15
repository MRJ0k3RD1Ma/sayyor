
<div class="row">
    <div class="col-md-12">
        <h4>Hayvon kasalliklari bo'yicha arizalarning ma'lumotlari</h4>
    </div>
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span class="text-muted  lh-1 d-block text-truncate">Barchasi</span>
                        <h4 class="">
                            <span class="counter-value" data-target="<?= \common\models\RouteSert::find()->where(['director_id'=>Yii::$app->user->id])->count('id')?>">0</span> ta
                        </h4>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <?php
    $lg = 'uz'; if(Yii::$app->language == 'ru'){$lg = 'ru';}
    foreach (\common\models\RouteStatus::find()->all() as $item):?>
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted lh-1 d-block text-truncate"><?= $item->{'name_'.$lg}?></span>
                            <h4 class="">
                                <span class="counter-value" data-target="<?= \common\models\RouteSert::find()->where(['director_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?>">0</span> ta
                            </h4>
                        </div>

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    <?php endforeach;?>

</div><!-- end row-->


<div class="row">
    <div class="col-md-12">
        <h4>Oziq-ovqat havfsizligi bo'yicha arizalarning ma'lumotlari</h4>
    </div>
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span class="text-muted lh-1 d-block text-truncate">Barchasi</span>
                        <h4 class="">
                            <span class="counter-value" data-target="<?= \common\models\FoodRoute::find()->where(['director_id'=>Yii::$app->user->id])->count('id')?>">0</span> ta
                        </h4>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <?php
    $lg = 'uz'; if(Yii::$app->language == 'ru'){$lg = 'ru';}
    foreach (\common\models\RouteStatus::find()->all() as $item):?>
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted lh-1 d-block text-truncate"><?= $item->{'name_'.$lg}?></span>
                            <h4 class="">
                                <span class="counter-value" data-target="<?= \common\models\FoodRoute::find()->where(['director_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?>">0</span> ta
                            </h4>
                        </div>

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    <?php endforeach;?>

</div><!-- end row-->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Hayvon kasalliklar tashhisi</h4>
            </div>
            <div class="card-body">

                <div id="pie_chart" data-colors='["#2ab57d",  "#fd625e"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Oziq-ovqat havfsizligi</h4>
            </div>
            <div class="card-body">

                <div id="pie_chart_food" data-colors='["#2ab57d",  "#fd625e"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
</div>


<?php

$not = \common\models\ResultAnimal::find()->where('consent_id is not null')->andWhere(['ads'=>0])
    ->andWhere(['>','updated',date('Y').'-01-01 00:00:00'])->count('id');
$has = \common\models\ResultAnimal::find()->where('consent_id is not null')->andWhere(['ads'=>1])
    ->andWhere(['>','updated',date('Y').'-01-01 00:00:00'])->count('id');

$not_food = \common\models\ResultFood::find()->where('consept_id is not null')->andWhere(['ads'=>0])
    ->andWhere(['>','updated',date('Y').'-01-01 00:00:00'])->count('id');
$has_food = \common\models\ResultFood::find()->where('consept_id is not null')->andWhere(['ads'=>1])
    ->andWhere(['>','updated',date('Y').'-01-01 00:00:00'])->count('id');
$this->registerJs("
function getChartColorsArray(e) {
    e = $(e).attr(\"data-colors\");
    return (e = JSON.parse(e)).map(function (e) {
        e = e.replace(\" \", \"\");
        if (-1 == e.indexOf(\"--\")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0
    })
}

    var pieColors = getChartColorsArray(\"#pie_chart\"), options = {
    chart: {height: 320, type: \"pie\"},
    series: [{$not}, {$has}],
    labels: [\"Tasdiqlanmagan\", \"Tasdiqlangan\"],
    colors: pieColors,
    legend: {
        show: !0,
        position: \"bottom\",
        horizontalAlign: \"center\",
        verticalAlign: \"middle\",
        floating: !1,
        fontSize: \"14px\",
        offsetX: 0
    },
    responsive: [{breakpoint: 600, options: {chart: {height: 240}, legend: {show: !1}}}]
};
(chart = new ApexCharts(document.querySelector(\"#pie_chart\"), options)).render();

var pieColors = getChartColorsArray(\"#pie_chart_food\"), options = {
    chart: {height: 320, type: \"pie\"},
    series: [{$not_food}, {$has_food}],
    labels: [\"Tasdiqlanmagan\", \"Tasdiqlangan\"],
    colors: pieColors,
    legend: {
        show: !0,
        position: \"bottom\",
        horizontalAlign: \"center\",
        verticalAlign: \"middle\",
        floating: !1,
        fontSize: \"14px\",
        offsetX: 0
    },
    responsive: [{breakpoint: 600, options: {chart: {height: 240}, legend: {show: !1}}}]
};
(chart = new ApexCharts(document.querySelector(\"#pie_chart_food\"), options)).render();

")
?>