<?php

namespace frontend\components;

use common\models\CompositeSamples;
use common\models\DestructionSampleAnimal;
use common\models\Samples;
use common\models\Sertificates;
use Yii;

class Animal
{
    public static function denySample($model,$cs,$route,$reg){
        $model->status_id = 6;
        $model->is_group = $cs->is_group;

        $dal = Sertificates::findOne($model->sert_id);
        $dal->status_id = 6;
        $dal->save();
        $des = new DestructionSampleAnimal();
        $des->sample_id = $cs->sample_id;
        $des->creator_id = Yii::$app->user->id;
        $num = DestructionSampleAnimal::find()->where(['org_id' => Yii::$app->user->identity->empPosts->org_id])->max('code_id');
        $num = (int)$num + 1;
        $des->code = get3num(Yii::$app->user->identity->empPosts->org_id) . '-' . $num;
        $des->destruction_date = date('Y-m-d h:i:s');
        $des->state_id = 2;
        $des->ads = $cs->ads;
        $des->consent_id = $route->director_id;
        $des->org_id = Yii::$app->user->identity->empPosts->org_id;
        $des->save();
        $model->save();
        $cs->save();
        if(CompositeSamples::find()->where(['sample_status_id'=>2])->andWhere(['registration_id '=>$reg->id])->count('registration_id') ==
            CompositeSamples::find()->where(['registration_id'=>$reg->id])->count('registration_id')){
            $reg->status_id = 6;
        }
        $reg->save();
    }

    public static function income($reg,$regid){
        $reg->emp_id = Yii::$app->user->id;
        $cs = CompositeSamples::find()->where(['registration_id' => $regid])->all();
        foreach ($cs as $item) {
            $samp = Samples::findOne($item->sample_id);
            $samp->status_id = 2;
            $samp->save();
            $samp = null;
        }
        $samp = Samples::findOne($cs[0]->sample_id);
        $sert = Sertificates::findOne($samp->sert_id);
        $sert->status_id = 2;
        $reg->status_id = 2;
        $sert->save();
        $reg->save();
    }


}