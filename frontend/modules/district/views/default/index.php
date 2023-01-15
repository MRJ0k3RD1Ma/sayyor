<?php

/* @var $this yii\web\View */

$this->title = Yii::t('client','Bosh sahifa');
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jarayondagi namunalar</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="100">0</span> ta
                            </h4>
                        </div>

                        <div class="col-6">
                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Barchasi </span>
                        <span class="badge bg-soft-success text-success"><span class="counter-value" data-target="865">0</span> ta</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Rad etilgan namunalar</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="6258">0</span>
                            </h4>
                        </div>
                        <div class="col-6">
                            <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jarayondagi mahsulotlar</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="102">0</span> ta
                            </h4>
                        </div>
                        <div class="col-6">
                            <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Barchasi </span>
                        <span class="badge bg-soft-success text-success"><span class="counter-value" data-target="500">0</span></span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Rad etilgan mahsulotlar</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="32">0</span> ta
                            </h4>
                        </div>
                        <div class="col-6">
                            <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row-->


</div>
