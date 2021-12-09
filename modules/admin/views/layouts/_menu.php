
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp'])?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= Yii::t('cp.menu','Bosh sahifa')?></span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/sert/'])?>">
                        <i data-feather="sliders"></i>
                        <span data-key="t-table"><?= Yii::t('cp.menu','Dalolatnomalar')?></span>

                    </a>
                </li>
                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/application/'])?>">
                        <i data-feather="sliders"></i>
                        <span data-key="t-table"><?= Yii::t('cp.menu','Arizalar')?></span>

                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Ma\'lumotnoma')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/inside'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Ichki')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/outside'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Tashqi')?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="folder"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Kontragentlar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/legal-entities'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Yuridik shaxslar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/individuals'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Jismoniy shaxslar')?></a></li>
                    </ul>
                </li>
                <li class="menu-title mt-2" data-key="t-components"><?= Yii::t('cp.menu','Sozlamalar')?></li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Foydalanuvchilar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/employees/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Foydalanuvchilar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/roles/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Foydalanuvchilar huquqlari')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/organizations/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Tashkilotlar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/organization-type/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Tashkilot turlari')?></a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
