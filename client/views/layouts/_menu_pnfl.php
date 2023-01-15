
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/ind'])?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= Yii::t('client','Bosh sahifa')?></span>
                    </a>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Dalolatnomalar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/ind/listanimal'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Hayvon kasalliklari tashhilari')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/ind/listfood'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Oziq-ovqat ekspertizalari')?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Arizalar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/ind/sertapp'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Hayvon kasalliklari tashhilari')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/ind/sertfood'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Oziq-ovqat ekspertizalari')?></a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
