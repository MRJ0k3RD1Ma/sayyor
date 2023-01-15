<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sertificates".
 *
 * @property string $sert_id Тизимдаги далолатнома рақами (автоматик генерация қилинади: ХХ-1-ХХХ-ХХХХХ (йил-далолатнома тури-лаборатория коди-тартиб рақами, масалан: 22-1-001-00001 – 2022 йил-касаллик диагностикаси-республика лабораторияси-2022 йилдаги далолатнома тартиб раками)
 * @property string|null $sert_num Далолатнома рақами (коғоздаги ёки РЕГИСТОНдаги)
 * @property string|null $sert_date
 * @property string $inn
 * @property string|null $sert_full
 * @property string $pnfl
 * @property string|null $created
 * @property string|null $sampler_name
 * @property string|null $sampler_position
 * @property int|null $vet_site_id
 * @property int $ownertype
 * @property int $status_id
 * @property int $nd_id
 * @property int $registon_id
 * @property int $is_registon
 *
 * @property Employees $operator0
 * @property Organizations $organization
 * @property Individuals $pnfl0
 * @property VetSites $vetSite
 */
class Sertificates extends \yii\db\ActiveRecord
{
    public $district,$region,$qfi,$ownertype,$organization_id,$owner_name,$operator,$organization;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sertificates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sert_date','ownertype','vet_site_id','sampler_name','sampler_position'],'required','on'=>'insert'],

            [['sert_date','created'], 'safe'],
            [['sert_id','ownertype', 'vet_site_id', 'district','region','qfi','status_id','registon_id','is_registon'], 'integer'],
            [[ 'sert_num'], 'string', 'max' => 100],
            [['pnfl', 'inn','sert_full','sampler_name','sampler_position'], 'string', 'max' => 255],
            ['status_id','default','value'=>1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sert_id' => Yii::t('model.sertificates', 'Dalolatnoma'),
            'sert_full' => Yii::t('model.sertificates', 'Dalolatnoma'),
            'sert_num' => Yii::t('model.sertificates', 'Dalolatnoma raqami(Qog\'ozdagi yoki registondagi)'),
            'sert_date' => Yii::t('model.sertificates', 'Sana'),
            'pnfl' => Yii::t('model.sertificates', 'PNFL'),
            'owner_name' => Yii::t('model.sertificates', 'Egasi'),
            'owner_type' => Yii::t('model.sertificates', 'Hayvon egasi'),
            'vet_site_id' => Yii::t('model.sertificates', 'Vet uchstka'),
            'operator' => Yii::t('model.sertificates', 'Operator'),
            'inn' => Yii::t('model.sertificates', 'INN(STIR)'),
            'region' => Yii::t('model.sertificates', 'Viloyat'),
            'district' => Yii::t('model.sertificates', 'Tuman'),
            'qfi' => Yii::t('model.sertificates', 'QFI'),
            'status_id' => Yii::t('model.sertificates', 'Status'),
            'ownertype' => Yii::t('model.sertificates', 'Hayvon egasi'),
            'sampler_position' => Yii::t('model.sertificates', 'Lavozim'),
            'sampler_name' => Yii::t('model.sertificates', 'Namuna olgan shaxs'),
        ];
    }

    /**
     * Gets query for [[Operator0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperator0()
    {
        return $this->hasOne(Employees::className(), ['id' => 'operator']);
    }

    public function getStatus(){
        return $this->hasOne(SertStatus::className(),['id'=>'status_id']);
    }


    /**
     * Gets query for [[Pnfl0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPnfl0()
    {
        return $this->hasOne(Individuals::className(), ['pnfl' => 'pnfl']);
    }
    public function getOwnerPnfl(){
        return $this->hasOne(Individuals::className(),['pnfl'=>'owner_pnfl']);
    }
    public function getOwnerInn(){
        return $this->hasOne(LegalEntities::className(),['inn'=>'owner_inn']);
    }

    /**
     * Gets query for [[VetSite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVetSite()
    {
        return $this->hasOne(VetSites::className(), ['id' => 'vet_site_id']);
    }
    public function getInn0(){
        return $this->hasOne(LegalEntities::className(),['inn'=>'inn']);
    }

    public function getSamples(){
        return $this->hasMany(Samples::className(),['sert_id'=>'id']);
    }
    public  function getRegionsCount($region_id){
        return $this->VetSites->soato0->region_id;
    }

}
