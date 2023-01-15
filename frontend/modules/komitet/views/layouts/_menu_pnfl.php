<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/komitet/']) ?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= Yii::t('client', 'Bosh sahifa') ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Arizalar ro\'yhati') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/sertapp']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                        </li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/sertfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Dalolatnomalar') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/listanimal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                        </li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/listfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Xabarlar') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportanimal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportdrugs']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Dori darmonlar') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Statistika') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-reganimal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari (Arizalar)') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-regfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari (Arizalar)') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-animal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari (Dalolatnomalar)') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-food']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari (Dalolatnomalar)') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
