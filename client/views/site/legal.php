<?php $this->title = Yii::t('client', 'Yuridik shaxs ma\'lumotlari'); ?>
<?php $form = \yii\widgets\ActiveForm::begin() ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="input">
                        <?= $form->field($model, 'inn')->textInput(['disabled' => true]) ?>
                    </div>
                    <div class="input">
                        <?= $form->field($model, 'name')->textInput() ?>
                    </div>
                    <div class="input">
                        <?= $form->field($model, 'tshx_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tshx::find()->all(), 'id', 'name_uz'), ['prompt' => 'Tashkiloy huquqiy shakli']) ?>
                    </div>
                    <div class="input">

                        <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(), 'region_id', 'name_lot')) ?>
                    </div>

                    <div class="input">

                        <?= $form->field($model, 'district')->dropDownList([]) ?>
                    </div>

                    <div class="input">

                        <?= $form->field($model, 'soato_id')->dropDownList([]) ?>
                    </div>

                    <div class="input">

                        <?= $form->field($model, 'status_id', ['options' => ['style' => 'display:none']])->textInput(['value' => 1, 'style' => 'display:none']) ?>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-success sign-in">Ma'lumotlarni saqlash</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php \yii\widgets\ActiveForm::end() ?>

<?php
$url_district = Yii::$app->urlManager->createUrl(['/site/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/site/get-qfi']);
$this->registerJs("

    
    $('#legalentities-region').change(function(){
        $.get('{$url_district}?id='+$('#legalentities-region').val()).done(function(data){
            $('#legalentities-district').empty();
            $('#legalentities-district').append(data);
        })        
    });
    $('#legalentities-district').change(function(){
        $.get('{$url_qfi}?id='+$('#legalentities-district').val()+'&regid='+$('#legalentities-region').val()).done(function(data){
            $('#legalentities-soato_id').empty();
            $('#legalentities-soato_id').append(data);
        })        
    });
")
?>