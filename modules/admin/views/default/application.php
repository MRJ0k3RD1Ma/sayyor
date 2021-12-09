<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-3">
                <a href="<?= Yii::$app->urlManager->createUrl(['/cp/sertificate-application'])?>">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','Mahsulot ekspertizasi uchun arizalar')?></h5>
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
                <a href="#">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h5 class="text-muted mb-3 lh-1 d-block text-truncate"><?= Yii::t('cp','Hayvon kasalligi tashhisi uchun ariza')?></h5>
                                </div>
                                <div class="col-2">
                                    <i class="fa fa-hotel"></i>
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
    i{
        font-size: 35px;
    }
</style>