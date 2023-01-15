<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_registration".
 *
 * @property int $id
 * @property string|null $inn
 * @property string|null $pnfl
 * @property int|null $organization_id
 * @property int|null $is_research
 * @property int|null $code_id
 * @property string|null $code
 * @property int|null $research_category_id
 * @property int|null $results_conformity_id
 * @property int|null $emp_id
 * @property string|null $reg_date
 * @property string|null $sender_name
 * @property string|null $sender_phone
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $ads
 * @property int|null $status_id
 *
 * @property FoodCompose[] $foodComposes
 * @property Organizations $organization
 * @property ResearchCategory $researchCategory
 * @property SertStatus $status
 */
class FoodRegistration extends \yii\db\ActiveRecord
{
    public $composite,$route_status;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organization_id','is_research','research_category_id','sender_name', 'sender_phone',],'required'],
            [['organization_id', 'is_research', 'code_id', 'research_category_id','res_id', 'results_conformity_id', 'emp_id', 'status_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            ['composite','each','rule'=>['string']],
            [['inn', 'pnfl', 'code', 'reg_date', 'sender_name', 'sender_phone', 'ads','res'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['research_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResearchCategory::className(), 'targetAttribute' => ['research_category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SertStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'inn' => Yii::t('food', 'STIR(INN)'),
            'pnfl' => Yii::t('food', 'JSHSHIR(PNFL)'),
            'organization_id' => Yii::t('food', 'Tashkilot'),
            'is_research' => Yii::t('food', 'Shoshilinch tekshiruv'),
            'code_id' => Yii::t('food', 'Raqami'),
            'code' => Yii::t('food', 'Raqami'),
            'research_category_id' => Yii::t('food', 'Kategoriyasi'),
            'results_conformity_id' => Yii::t('food', 'Sertifikat'),
            'emp_id' => Yii::t('food', 'Operator'),
            'reg_date' => Yii::t('food', 'Sana'),
            'sender_name' => Yii::t('food', 'Arizachi FIO'),
            'sender_phone' => Yii::t('food', 'Arizachi telefon'),
            'created' => Yii::t('food', 'Yaratildi'),
            'updated' => Yii::t('food', 'Updated'),
            'composite' => Yii::t('food', 'Namunalar'),
            'ads' => Yii::t('food', 'Izoh'),
            'status_id' => Yii::t('food', 'Status'),
            'res_id'=>'Raqami',
            'res'=>'Raqami'
        ];
    }

    public function getComp(){
        return $this->hasMany(FoodCompose::className(),['registration_id'=>'id']);
    }
    /**
     * Gets query for [[FoodComposes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodComposes()
    {
        return $this->hasMany(FoodCompose::className(), ['registration_id' => 'id']);
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

    public function getSamples(){
        return FoodSamples::find()->where('id in (select sample_id from food_compose where registration_id='.$this->id.')')->all();
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

    public function getConformity(){
        return $this->hasOne(ResultsConformity::className(),['id'=>'results_conformity_id']);
    }
    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(SertStatus::className(), ['id' => 'status_id']);
    }

    public function getInn0(){
        return $this->hasOne(LegalEntities::className(),['inn'=>'inn']);
    }
    public function getPnfl0(){
        return $this->hasOne(Individuals::className(),['pnfl'=>'pnfl']);
    }
}
