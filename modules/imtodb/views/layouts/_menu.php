
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
                        <span data-key="t-dashboard"><?= Yii::t('cp.menu','Dashboard')?></span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components"><?= Yii::t('cp.menu','Elements')?></li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Viloyatlar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/regions'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Viloyatlar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/districts/'])?>" data-key="t-data-tables"><?= Yii::t('cp.menu','Tumanlar')?></a></li>
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
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
