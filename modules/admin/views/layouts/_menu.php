
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Elements</li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables"><?= Yii::t('app','Viloyatlar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/employee/regions'])?>" data-key="t-basic-tables"><?= Yii::t('app','Viloyatlar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/employee/districts/'])?>" data-key="t-data-tables"><?= Yii::t('app','Tumanlar')?></a></li>
                    </ul>
                </li>
                <li class="menu-title mt-2" data-key="t-components"><?= Yii::t('app','Sozlamalar')?></li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-tables"><?= Yii::t('app','Foydalanuvchilar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/employee/employees/index'])?>" data-key="t-basic-tables"><?= Yii::t('app','Foydalanuvchilar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/employee/districts/'])?>" data-key="t-data-tables"><?= Yii::t('app','Tumanlar')?></a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
