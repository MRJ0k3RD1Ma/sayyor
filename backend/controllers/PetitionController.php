<?php


namespace backend\controllers;

use common\models\AnimalCategory;
use common\models\Animals;
use common\models\Animaltype;
use common\models\CompositeSamples;
use common\models\Emlash;
use common\models\Individuals;
use common\models\LegalEntities;
use common\models\Organizations;
use common\models\SampleRegistration;
use common\models\Samples;
use common\models\Sertificates;
use common\models\Vaccination;
use Yii;
use common\models\DistrictView;
use common\models\QfiView;
use common\models\RegionsView;
use common\models\VetSites;
use yii\base\BaseObject;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

class PetitionController extends ActiveController
{
    public $modelClass = "common\models\SampleRegistration";

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] =[
            'class'=>Cors::className()
        ];

        $behaviors['formats'] = [
            'class'=>'yii\filters\ContentNegotiator',
            'formats'=>[
                'application/json'=>Response::FORMAT_JSON
            ]
        ];
        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create'],$actions['index']);


        return $actions;
    }

    public function actionGetregion(){
        $model = RegionsView::find()->select(['region_id','name_lot','name_cyr','name_ru'])->all();
        return $model;
    }

    public function actionGetdistrict($id){
        $model = DistrictView::find()->where(['region_id'=>$id])->select(['district_id','name_lot','name_cyr','name_ru'])->all();
        return $model;
    }

    public function actionGetqfi($id,$regid){
        $model = QfiView::find()->where(['district_id'=>$id])->andWhere(['region_id'=>$regid])->select(['MHOBT_cod','name_lot','name_cyr','name_ru'])->all();
        return $model;
    }

    public function actionGetVet($id,$regid){
        $model = VetSites::find()->filterWhere(['like','soato','17'.$regid.$id])->all();
        return $model;
    }

    public function actionGetcategory(){
        return AnimalCategory::find()->select(['id','name_uz','name_ru'])->all();
    }
    public function actionGettype(){
        return Animaltype::find()->select(['id','name_uz','name_ru'])->all();
    }

    public function actionGetorg(){
        return Organizations::find()->where(['type_id'=>1])->all();
    }

    public function actionCreate(){

        $model = new SampleRegistration();
        $model->is_registon = 1;

        if(Yii::$app->request->isPost){

            $transaction = Yii::$app->db->beginTransaction();
            $allok = true;
            $res = [];
            $errors  = [];
            $errors['code'] = 1;
            try {

                $post = Yii::$app->request->post();
                $sert = new Sertificates();
                $res['begin'] = 1;
                $sert->registon_id = $post['sert']['registon_id'];
                $sert->sert_num = $post['sert']['number'];
                $sert->is_registon = 1;
                $sert->sert_date = $post['sert']['sert_date'];
                $sert->sampler_name = $post['sert']['sampler_name'];
                $sert->sampler_position = $post['sert']['sampler_position'];
                $sert->vet_site_id = $post['sert']['vet_site_id'];
                $sert->status_id = 1;

                if($post['sert']['ownertype']==1){
                    if($ind = Individuals::findOne(['pnfl'=>$post['sert']['owner']['pnfl']])){
                        $sert->owner_pnfl = $ind->pnfl;
                        $res['pnfl'] = 1;
                    }else{
                        $ind = new Individuals();
                        $ind->pnfl = $post['sert']['owner']['pnfl'];
                        $ind->name = $post['sert']['owner']['name'];
                        $ind->surname = $post['sert']['owner']['surname'];
                        $ind->middlename = $post['sert']['owner']['middlename'];
                        $ind->soato_id = $post['sert']['owner']['soato_id'];
                        $ind->adress = $post['sert']['owner']['adress'];
                        $ind->passport = $post['sert']['owner']['passport'];
                        if($ind->save()){
                            $sert->owner_pnfl = $ind->pnfl;
                            $res['pnfl'] = 1;
                        }else{
                            $errors ['code'] = 0;
                            $errors['data']['owner'] = "Owner malumotlari to\'liq emas";
                        }

                    }
                }else{
                    if($ind = LegalEntities::findOne(['inn'=>$post['sert']['owner']['inn']])){
                        $sert->owner_inn = $ind->inn;
                        $res['inn'] = 1;
                    }else{
                        $ind = new LegalEntities();
                        $ind->inn = $post['sert']['owner']['inn'];
                        $ind->name = $post['sert']['owner']['name'];
                        $ind->tshx_id = $post['sert']['owner']['tshx_id'];
                        $ind->soogu = $post['sert']['owner']['adress'];
                        $ind->soato_id = $post['sert']['owner']['soato_id'];
                        $ind->status_id = 1;

                        if($ind->save()){
                            $sert->owner_inn = $ind->inn;
                            $res['inn'] = 1;
                        }else{
                            $errors ['code'] = 0;
                            $errors['data']['owner'] = "Owner ma\'lumotlari to'liq emas";
                        }
                    }
                }

                if($post['sender_type']==1){
                    if($ind = Individuals::findOne(['pnfl'=>$post['sender']['pnfl']])){
                        $sert->pnfl = $ind->pnfl;
                        $res['sertpnfl'] = 1;
                    }else{
                        $ind = new Individuals();
                        $ind->pnfl = $post['sender']['pnfl'];
                        $ind->name = $post['sender']['name'];
                        $ind->surname = $post['sender']['surname'];
                        $ind->middlename = $post['sender']['middlename'];
                        $ind->soato_id = $post['sender']['soato_id'];
                        $ind->adress = $post['sender']['adress'];
                        $ind->passport = $post['sender']['passport'];
                        $ind->save();
                        if($ind->save()){
                            $sert->pnfl = $ind->pnfl;
                            $res['sertpnfl'] = 1;
                        }else{
                            $errors ['code'] = 0;
                            $errors['data']['sender'] = "Sender ma'lumotlari to'liq emas";
                        }

                    }
                }else{
                    if($ind = LegalEntities::findOne(['inn'=>$post['sender']['inn']])){
                        $sert->inn = $ind->inn;
                        $res['sertinn'] = 1;
                    }else{
                        $ind = new LegalEntities();
                        $ind->inn = $post['sender']['inn'];
                        $ind->name = $post['sender']['name'];
                        $ind->tshx_id = $post['sender']['tshx_id'];
                        $ind->soogu = $post['sender']['adress'];
                        $ind->soato_id = $post['sender']['soato_id'];
                        $ind->status_id = 1;
                        $ind->save();

                        if($ind->save()){
                            $sert->inn = $ind->inn;
                            $res['sertinn'] = 1;
                        }else{
                            $errors ['code'] = 0;
                            $errors['data']['sender'] = "Sender ma'lumotlari to'liq emas";
                        }
                    }
                }



                if(!$sert->inn and !$sert->pnfl){
                    $allok = false;
                    $res['sertinnpnfl'] = 0;
                    $errors ['code'] = 0;
                    $errors['data']['owner'] = "Owner ma'lumotlari to'liq emas";
                }else{
                    $res['sertinnpnfl'] = 1;
                }


                if(!$sert->owner_inn and !$sert->owner_pnfl){
                    $allok = false;
                    $res['innpnfl'] = 0;
                    $errors ['code'] = 0;
                    $errors['data']['sender'] = "Sender ma'lumotlari to'liq emas";
                }else{
                    $res['innpnfl'] = 1;
                }



                /*Sert code generate */
                $num = Sertificates::find()->filterWhere(['like','sert_date',date('Y')])->max('sert_id');
                $vet = VetSites::findOne($sert->vet_site_id);
                $code = $vet->soato0->region_id.$vet->soato0->district_id.'-'.   substr(date('Y'),2,2).'-';

                $num = $num+1;
                $code .= $num;
                $sert->sert_id = $num;
                $sert->sert_full = $code;

                if($sert->save()){
                    $res['sert'] = 1;
                    $samples = $post['sert']['samples'];
                    $sample_ids = [];
                    $n=0;
//                    $res['samples'] = [];
                    foreach ($samples as $k => $item){

                        $nam = new Samples();
                        $nam->sert_id = $sert->id;
                        $nam->registon_id = $item['registon_id'];
                        $nam->label = $item['label'];
                        $nam->sample_type_is = $item['type_id'];
                        $nam->sample_box_id = $item['box_id'];

                        $animal = $item['animal'];

                        $anim = new Animals();
                        $anim->name = $animal['name'];
                        $anim->gender = $animal['gender'];
                        $anim->cat_id = $animal['cat_id'];
                        $anim->birthday = date('Y-m-d',strtotime($animal['birthday']));
                        $anim->inn = $animal['inn'];
                        $anim->pnfl = $animal['pnfl'];
                        $anim->vet_site_id = $animal['vet_site_id'];
                        $anim->bsual_tag = $animal['bsual_tag'];
                        $anim->type_id = $animal['type_id'];
                        $anim->adress = $animal['adress'];

                        if($anim->save()){
                            $res['animal'] = 1;
                        }else{
                            $errors['code'] = 0;
                            $errors['data']['animal'] = "Hayvon ma'lumotlari to'liq emas";
                            $errors['data']['animal_code'] = $anim;
                        }

                        if(isset($animal['vaccination']) and $vac = $animal['vaccination']){
                            $res['vaccination'] = 1;
                            foreach ($vac as $key=>$i){
                                $v = new Vaccination();
                                $v->vaccina_id = $i['vaccina_id'];
                                $v->disease_id = $i['disease_id'];
                                $v->disease_date = $i['disease_date'];
                                $v->animal_id = $anim->id;
                                $v->save(false);
                                $res['vac'][$key] = $v;
                            }

                        }
                        if(isset($animal['emlash']) and  $em = $animal['emlash']){
                            $res['emlash'] = 1;
                            foreach ($em as $key=>$i){
                                $e = new Emlash();
                                $e->animal_id = $anim->id;
                                $e->antibiotic = $i['antibiotic'];
                                $e->emlash_date = $i['date'];
                                $e->save(false);
                                $res['eml'][$key] = $e;
                            }
                        }



                        $nam->animal_id = $anim->id;
                        $nam->suspected_disease_id = $item['disease_id'];
                        $nam->test_mehod_id = $item['mehod_id'];
                        $nam->repeat_code = $item['repeat_code'];
                        $nam->status_id = 1;
                        /*namuna raqami generatsiyasi*/

                        $num = Samples::find()->filterWhere(['like','kod',$sert->sert_full])->max('samp_id');

                        $code = $sert->sert_full;

                        $num = $num+1;

                        $nam->kod = $code.'/'.$num;
                        $nam->samp_id = $num;

                        if($nam->save()){
                            $res['namuna'][$k] = 1;
                        }else{
                            $res['namuna'][$k] = 0;
                        }

                        $sample_ids[$n++] = $nam->id;
                    }
                    if($n==0){
                        $allok = false;
                        $res['n'] = 0;
                        $errors ['code'] = 0;
                        $errors['data']['animal'] = "animal ma'lumotlari to'liq emas";
                    }else{
                        $res['n'] = $n;
                    }
                }else{
                    $allok = false;
                    $res['sert'] = 0;
                    $errors ['code'] = 0;
                    $errors['data']['sert'] = "sert ma'lumotlari to'liq emas";
                }

                $model->registon_id = $post['registon_id'];
                $model->organization_id = $post['organization_id'];
                $model->sender_name = $post['sender_name'];
                $model->sender_phone = $post['sender_phone'];
                $model->research_category_id = $post['research_category_id'];
                $model->is_research = $post['is_research'];
                $model->status_id = 1;


                $num = SampleRegistration::find()->filterWhere(['like','created',date('Y')])->max('code_id');

                $code = substr(date('Y'),2,2).'-1-'.get3num($model->organization_id).'-';
                $model->status_id = 1;
                $num = $num+1;
                $code .= $num;
                $model->code = $code;
                $model->code_id = $num;

                if($post['sender_type']==1){
                    if($ind = Individuals::findOne(['pnfl'=>$post['sender']['pnfl']])){
                        $model->pnfl = $ind->pnfl;
                        $res['senderpnfl'] = 1;
                    }else{
                        $ind = new Individuals();
                        $ind->pnfl = $post['sender']['pnfl'];
                        $ind->name = $post['sender']['name'];
                        $ind->surname = $post['sender']['surname'];
                        $ind->middlename = $post['sender']['middlename'];
                        $ind->soato_id = $post['sender']['soato_id'];
                        $ind->adress = $post['sender']['adress'];
                        $ind->passport = $post['sender']['passport'];
                        $ind->save();
                        $model->pnfl = $ind->pnfl;
                        $res['senderpnfl'] = 1;
                    }
                }else{
                    if($ind = LegalEntities::findOne(['inn'=>$post['sender']['inn']])){
                        $model->inn = $ind->inn;
                        $res['senderinn'] = 1;
                    }else{
                        $ind = new LegalEntities();
                        $ind->inn = $post['sender']['inn'];
                        $ind->name = $post['sender']['name'];
                        $ind->tshx_id = $post['sender']['tshx_id'];
                        $ind->soogu = $post['sender']['adress'];
                        $ind->soato_id = $post['sender']['soato_id'];
                        $ind->status_id = 1;
                        $ind->save();
                        $model->inn = $ind->inn;
                        $res['senderinn'] = 1;
                    }
                }

                if(!$model->inn and !$model->pnfl){
                    $allok = false;
                    $res['senderinnpnfl'] = 0;
                }else{
                    $res['senderinnpnfl'] = 1;
                }

                $res['reg'] = $model;
                if(!$model->save()){
                    $allok = false;
                    $res['regis'] = 0;
                }
                $m = 0;
                foreach ($sample_ids as $item){
                    $m++;
                    $com = new CompositeSamples();
                    $com->sample_status_id = 1;
                    $com->sample_id = $item;
                    $com->registration_id = $model->id;
                    $com->save(false);
                }
                if($allok and $m = $n){
                    $transaction->commit();
                }else{
                    $transaction->rollBack();
                }
            }catch (\Exception $e){
                $transaction->rollBack();
            }

            if($allok){
                return $errors;
            }else{
                return $errors;
            }
        }

        return 0;
    }

}