
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/legal'])?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= Yii::t('client','Bosh sahifa')?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Arizalar ro\'yhati')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/legal/sertapp'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Hayvon kasalliklari tashhilari')?></a></li>
                        <li><a href="#" data-key="t-basic-tables"><?= Yii::t('cp.menu','Oziq-ovqat ekspertizalari')?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Dalolatnomalar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/legal/listanimal'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Hayvon kasalliklari tashhilari')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/legal/listfood'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Oziq-ovqat ekspertizalari')?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/legal/create'])?>">
                        <i data-feather="mail"></i>
                        <span data-key="t-dashboard"><?= Yii::t('client','Dalolatnoma qo\'shish')?></span>
                    </a>
                </li>


            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
