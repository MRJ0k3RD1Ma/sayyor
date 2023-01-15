
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?= Yii::$app->urlManager->createUrl(['/'])?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/favicon.ico" alt="" height="24">
                                </span>
                    <span class="logo-lg">
                                    <img src="/favicon.ico" alt="" height="24"> <span class="logo-txt">VIS-Sayyor</span>
                                </span>
                </a>

                <a href="<?= Yii::$app->urlManager->createUrl(['/'])?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/favicon.ico" alt="" height="24">
                                </span>
                    <span class="logo-lg">
                                    <img src="/favicon.ico" alt="" height="24"> <span class="logo-txt">VIS-Sayyor</span>
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>


        </div>

        <div class="d-flex">



            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="/design/assets/images/<?= Yii::$app->language ?>.jpg" alt="Header Language" height="16">

                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="uz">
                        <img src="/design/assets/images/uz.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">O'zbek</span>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="oz">
                        <img src="/design/assets/images/oz.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Узбек</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="/design/assets/images/ru.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Русский</span>
                    </a>

                    <?php

                    $site = Yii::$app->urlManager->createUrl(['/site/changelanguage']);
                    $this->registerJs("
                            $('.language').click(function(){
                                var lang = this.getAttribute('data-lang');
                                var url = document.URL;
                                if(url.substr(url.length - 1) != '/'){
                                    url  = url + '/';
                                }
                                
                                if(lang == 'uz'){
                                    url = url.replace('/oz/','/'+lang+'/');
                                    url = url.replace('/ru/','/'+lang+'/');
                                   
                                }
                                if(lang == 'oz'){
                                    url = url.replace('/uz/','/'+lang+'/');
                                    url = url.replace('/ru/','/'+lang+'/');
                                }
                                if(lang == 'ru'){
                                    url = url.replace('/uz/','/'+lang+'/');
                                    url = url.replace('/oz/','/'+lang+'/');
                                }
                                window.location.replace(url);
                            })
                        ");
                    ?>

                </div>
            </div>

          <!--  <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="/design/assets/images/avatar-1.jpg"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= Yii::$app->session->get('doc_name') ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a class="dropdown-item" data-method="post" href="<?= Yii::$app->urlManager->createUrl(['/site/logout'])?>"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Chiqish</a>
                </div>
            </div>

        </div>
    </div>
</header>
