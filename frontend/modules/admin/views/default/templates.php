<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-4">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/regulation/']) ?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-2 d-block text-truncate"><?= Yii::t('cp', 'Normativ hujjatlar') ?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/template-unit/']) ?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-2 d-block text-truncate"><?= Yii::t('cp', 'Shablon birliklari') ?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/']) ?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-2 d-block text-truncate"><?= Yii::t('cp', 'Hayvon kasalliklari tashhisi') ?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/template-food/']) ?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-2 d-block text-truncate"><?= Yii::t('cp', 'Oziq-ovqat tashhisi') ?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/food-req/']) ?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-2 d-block text-truncate"><?= Yii::t('cp', 'Oziq-ovqat ekspertizasi talablari') ?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>

<style>
    i {
        font-size: 35px;
    }
</style>