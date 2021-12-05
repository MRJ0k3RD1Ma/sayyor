<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-3">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/vet-sites'])?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','Vet uchastkalar')?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-hotel"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/soato'])?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','SOATO')?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-hotel"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/tshx'])?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','Tashkiliy huquqiy shakl')?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-hotel"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <?php if(false){?>
            <div class="col-md-3">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/legal-entities'])?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','Yuridik shaxslar')?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-user-tie"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/individuals'])?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','Jismoniy shaxslar')?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </a>
            </div>

            <?php }?>


        </div>
    </div>
</div>
<style>
    i{
        font-size: 35px;
    }
</style>