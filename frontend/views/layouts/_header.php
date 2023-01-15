
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?= Yii::$app->urlManager->createUrl(['/'])?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/design/assets/images/vet.png" alt="" height="24">
                                </span>
                    <span class="logo-lg">
                                    <img src="/design/assets/images/vet.png" alt="" height="24"> <span class="logo-txt">VIS-Sayyor</span>
                                </span>
                </a>

                <a href="<?= Yii::$app->urlManager->createUrl(['/'])?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/design/assets/images/vet.png" alt="" height="24">
                                </span>
                    <span class="logo-lg">
                                    <img src="/design/assets/images/vet.png" alt="" height="24"> <span class="logo-txt">VIS-Sayyor</span>
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>


        </div>

        <div class="d-flex">

           <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell icon-lg"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <span class="badge bg-danger rounded-pill">5</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown" style="">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar="init" style="max-height: 230px;"><div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <a href="#!" class="text-reset notification-item">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Million dastur OK</h6>
                                                        <div class="font-size-13 text-muted">
                                                            <p class="mb-1">Hayvon kasalliklari tashhisi uchun ariza</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#!" class="text-reset notification-item">
                                                <div class="d-flex">

                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Million dastur OK</h6>
                                                        <div class="font-size-13 text-muted">
                                                            <p class="mb-1">Mahsulot ekspertizasi</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none; height: 129px;"></div>
                        </div>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>
-->
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
                    <!--<img class="rounded-circle header-profile-user" src="/design/assets/images/avatar-1.jpg"
                         alt="Header Avatar">-->
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= Yii::$app->user->identity->name?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profil sozlamalari</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-method="post" href="<?= Yii::$app->urlManager->createUrl(['/site/logout'])?>"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Chiqish</a>
                </div>
            </div>

        </div>
    </div>
</header>
