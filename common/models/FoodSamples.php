<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "food_samples".
 *
 * @property int $id
 * @property string|null $samp_code Namunaning raqami toliq
 * @property int|null $samp_id namunaning raqami faqat son
 * @property int|null $sert_id namunaning food_sample_sertification idsi
 * @property int|null $unit_id birligi
 * @property int|null $count soni
 * @property int $_country Davlat nomi
 * @property int|null $sample_box_id
 * @property int|null $sample_condition_id
 * @property string|null $total_amount
 * @property int|null $verification_sample
 * @property string|null $producer
 * @property string|null $serial_num
 * @property string|null $manufacture_date
 * @property string|null $sell_by yaroqlilik muddati
 * @property string|null $coments
 * @property int|null $laboratory_test_type_id
 * @property int|null $status_id
 * @property int|null $emp_id
 * @property int|null $food_id
 * @property int|null $category_id
 * @property string|null $created
 * @property string|null $updated
 *
 * @property LaboratoryTestType $laboratoryTestType
 * @property SampleBoxes $sampleBox
 * @property SampleConditions $sampleCondition
 * @property FoodSamplingCertificate $sert
 * @property Units $unit
 * @property Countres $country
 */
class FoodSamples extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_samples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id','food_id','category_id','count','sample_box_id','sample_condition_id', 'verification_sample', 'laboratory_test_type_id','manufacture_date', 'sell_by', 'total_amount', 'producer', 'serial_num',],'required','on'=>'insert'],
            [['samp_id', 'sert_id', 'unit_id','emp_id', 'count', 'is_group','_country', 'sample_box_id', 'sample_condition_id', 'verification_sample', 'laboratory_test_type_id', 'status_id', 'state_id'], 'integer'],
            [['_country'], 'required'],
            [['manufacture_date', 'sell_by', 'created', 'updated'], 'safe'],
            [['samp_code', 'total_amount', 'producer', 'serial_num', 'coments'], 'string', 'max' => 255],
            [['laboratory_test_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => LaboratoryTestType::className(), 'targetAttribute' => ['laboratory_test_type_id' => 'id']],
            [['sample_box_id'], 'exist', 'skipOnError' => true, 'targetClass' => SampleBoxes::className(), 'targetAttribute' => ['sample_box_id' => 'id']],
            [['sample_condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => SampleConditions::className(), 'targetAttribute' => ['sample_condition_id' => 'id']],
            [['sert_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodSamplingCertificate::className(), 'targetAttribute' => ['sert_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Units::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'food_id' => Yii::t('food', 'Mahsulot guruhi'),
            'category_id' => Yii::t('food', 'Mahsulot kategoriyasi'),
            'samp_code' => Yii::t('food', 'Raqami'),
            'samp_id' => Yii::t('food', 'raqami'),
            'sert_id' => Yii::t('food', 'Dalolatnoma'),
            'unit_id' => Yii::t('food', 'Birlik'),
            'count' => Yii::t('food', 'Soni'),
            'sample_box_id' => Yii::t('food', 'Namuna o\'rami'),
            'sample_condition_id' => Yii::t('food', 'Namuna holati'),
            'total_amount' => Yii::t('food', 'Toplam(partiya) miqdori'),
            'verification_sample' => Yii::t('food', 'Nazorat namunasi'),
            'producer' => Yii::t('food', 'Ishlab chiqaruvchi'),
            'serial_num' => Yii::t('food', 'Seriya raqami'),
            'manufacture_date' => Yii::t('food', 'Ishlab chiqarilgan sana'),
            'sell_by' => Yii::t('food', 'Muddati'),
            'coments' => Yii::t('food', 'Qo\'shimcha ma\'lumot'),
            'laboratory_test_type_id' => Yii::t('food', 'Laboratoriya test turi'),
            'created' => Yii::t('food', 'Yaratildi'),
            'updated' => Yii::t('food', 'O\'zgartirildi'),
            'status_id' => Yii::t('food', 'Status'),
            'emp_id' => Yii::t('food', 'Ro\'yhatga oluvchi'),
            '_country' => Yii::t('food', 'Davlat'),
            'is_group' => Yii::t('food', 'Birlashgan namunalardan'),
        ];
    }

    /**
     * Gets query for [[LaboratoryTestType]].
     *
     * @return ActiveQuery
     */
    public function getLaboratoryTestType()
    {
        return $this->hasOne(LaboratoryTestType::className(), ['id' => 'laboratory_test_type_id']);
    }

    public function getCategory(){
        return $this->hasOne(FoodCategory::className(),['id'=>'category_id']);
    }
    public function getFood(){
        return $this->hasOne(Food::className(),['id'=>'food_id']);
    }

    /**
     * Gets query for [[SampleBox]].
     *
     * @return ActiveQuery
     */
    public function getSampleBox()
    {
        return $this->hasOne(SampleBoxes::className(), ['id' => 'sample_box_id']);
    }

    /**
     * Gets query for [[SampleCondition]].
     *
     * @return ActiveQuery
     */
    public function getSampleCondition()
    {
        return $this->hasOne(SampleConditions::className(), ['id' => 'sample_condition_id']);
    }

    public function getEmp(){
        return $this->hasOne(Employees::className(),['id'=>'emp_id']);
    }
    /**
     * Gets query for [[Sert]].
     *
     * @return ActiveQuery
     */
    public function getSert()
    {
        return $this->hasOne(FoodSamplingCertificate::className(), ['id' => 'sert_id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(SertStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCountry(){
        return $this->hasOne(Countres::class,['id'=>'_country']);
    }
    public function getSampleTypeIs()
    {
        return $this->hasOne(SampleTypes::className(), ['id' => 'sample_type_is']);
    }
    public function getRoute(){
        return $this->hasOne(FoodRoute::className(), ['sample_id'=>'id']);
    }

}
