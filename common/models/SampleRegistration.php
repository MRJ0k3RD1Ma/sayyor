<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sample_registration".
 *
 * @property int $id
 * @property string|null $pnfl
 * @property string|null $inn
 * @property int|null $is_research Текшириладими, йўқми?
 * @property string|null $code
 * @property string|null $sender_name
 * @property string|null $sender_phone
 * @property int|null $research_category_id Пуллк, текин
 * @property int|null $results_conformity_id НД соответствия результатов требованиям
 * @property int|null $organization_id
 * @property int|null $emp_id
 * @property int|null $res_id
 * @property string|null $res
 * @property string|null $reg_date
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $disease_id
 * @property int|null $reg_id
 * @property int|null $code_id
 * @property int|null $composite
 * @property int|null $is_registon
 * @property int|null $registon_id
 * @property string|null $ads
 *
 * @property Organizations $organization
 * @property ResearchCategory $researchCategory
 * @property CompositeSamples $comp
 */
class SampleRegistration extends \yii\db\ActiveRecord
{
    public $composite,$route_status;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organization_id','is_research','research_category_id','sender_name', 'sender_phone',],'required'],
            [['is_research','reg_id','code_id', 'research_category_id','registon_id','is_registon', 'results_conformity_id','res_id', 'organization_id', 'emp_id','status_id', ], 'integer'],
            [['reg_date','created','updated'], 'safe'],
            ['composite','each','rule'=>['integer']],
            ['ads','string','max'=>500],
            [['pnfl', 'inn','res', 'code','sender_name','sender_phone'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['research_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResearchCategory::className(), 'targetAttribute' => ['research_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'pnfl' => Yii::t('model', 'JSHSHIR(PNFL)'),
            'inn' => Yii::t('model', 'STIR(INN)'),
            'is_research' => Yii::t('model', 'Shoshilinch tekshiruv'),
            'code' => Yii::t('model', 'Kod'),
            'research_category_id' => Yii::t('model', 'Tekshiruv turi'),
            'results_conformity_id' => Yii::t('model', 'Talablarning natijaga muvofiqligi'),
            'organization_id' => Yii::t('model', 'Tekshiruvchi tashkilot'),
            'emp_id' => Yii::t('model', 'Registrator'),
            'reg_date' => Yii::t('model', 'Ro\'yhatga olingan sana'),
            'disease_id' => Yii::t('model', 'Kasallik turi'),
            'composite' => Yii::t('model', 'Namunalar'),
            'sender_name' => Yii::t('model', 'Ariza yuboruvchi FIO'),
            'sender_phone' => Yii::t('model', 'Ariza yuboruvchi telefoni'),
            'reg_id' => Yii::t('model', 'Namuna qabul qiluvchi'),
            'created' => Yii::t('model', 'Yuborilgan vaqti'),
            'ads' => Yii::t('model', 'Izoh'),
            'res' => Yii::t('model', 'res'),
            'res_id' => Yii::t('model', 'resid'),
            'status_id' => Yii::t('model', 'Holat'),
        ];
    }

    public function getStatus(){
        return $this->hasOne(SertStatus::className(),['id'=>'status_id']);
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organization_id']);
    }

    public function getReg(){
        return $this->hasOne(Employees::className(),['id'=>'reg_id']);
    }
    /**
     * Gets query for [[ResearchCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResearchCategory()
    {
        return $this->hasOne(ResearchCategory::className(), ['id' => 'research_category_id']);
    }
    public function getInn0(){
        return $this->hasOne(LegalEntities::className(),['inn'=>'inn']);
    }
    public function getPnfl0(){
        return $this->hasOne(Individuals::className(),['pnfl'=>'pnfl']);
    }

    public function getComp(){
        return $this->hasMany(CompositeSamples::className(),['registration_id'=>'id']);
    }


    public function getConformity(){
        return $this->hasOne(ResultsConformity::className(),['id'=>'results_conformity_id']);
    }
}
