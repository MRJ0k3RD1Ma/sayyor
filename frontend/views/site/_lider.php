
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
                            <span class="counter-value" data-target="<?= \common\models\RouteSert::find()->where(['leader_id'=>Yii::$app->user->id])->count('id')?>">0</span> ta
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
                                <span class="counter-value" data-target="<?= \common\models\RouteSert::find()->where(['leader_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?>">0</span> ta
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
                            <span class="counter-value" data-target="<?= \common\models\FoodRoute::find()->where(['leader_id'=>Yii::$app->user->id])->count('id')?>">0</span> ta
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
                                <span class="counter-value" data-target="<?= \common\models\FoodRoute::find()->where(['leader_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?>">0</span> ta
                            </h4>
                        </div>

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    <?php endforeach;?>

</div><!-- end row-->
