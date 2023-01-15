<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_sampling_certificate".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $food_id
 * @property string|null $inn
 * @property string|null $pnfl
 * @property int|null $sampling_site
 * @property string|null $sampling_adress
 * @property string|null $sampler_person_pnfl
 * @property string|null $sampler_person_inn
 * @property int|null $verification_pupose_id
 * @property string|null $sampling_date
 * @property string|null $send_sample_date
 * @property int|null $based_public_information
 * @property int|null $message_number
 * @property int|null $sampling_soato
 * @property int|null $status_id
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $explanations
 * @property string|null $sert_date
 * @property string|null $sert_number
 * @property string|null $sampler_name
 * @property string|null $sampler_position
 *
 * @property FoodSamples[] $foodSamples
 * @property ProductExpertise[] $productExpertises
 * @property VerificationPurposes $verificationPupose
 */
class FoodSamplingCertificate extends \yii\db\ActiveRecord
{
    public $region,$ownertype,$district;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_sampling_certificate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ownertype','sampling_site','sampler_name','sampler_position','sert_number','sert_date','sampling_date','sampling_soato','sampling_adress','verification_pupose_id'],'required','on'=>'insert'],
            [['food_id','ownertype', 'sampling_site','sampling_soato', 'verification_pupose_id','status_id','state_id', 'based_public_information', 'message_number'], 'integer'],
            [['sampling_date', 'send_sample_date', 'created', 'updated','sert_date'], 'safe'],
            [['code', 'inn', 'pnfl', 'sampling_adress', 'sampler_name','sampler_position','sampler_person_pnfl','sert_number', 'sampler_person_inn','explanations'], 'string', 'max' => 255],
            [['verification_pupose_id'], 'exist', 'skipOnError' => true, 'targetClass' => VerificationPurposes::className(), 'targetAttribute' => ['verification_pupose_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.food_sampling_certificate', 'ID'),
            'code' => Yii::t('model.food_sampling_certificate', 'Raqami'),
            'food_id' => Yii::t('model.food_sampling_certificate', 'Food ID'),
            'inn' => Yii::t('model.food_sampling_certificate', 'STIR(INN)'),
            'pnfl' => Yii::t('model.food_sampling_certificate', 'JSHSHIR(PNFL)'),
            'sampling_site' => Yii::t('model.food_sampling_certificate', 'Vet uchaska'),
            'sampling_soato' => Yii::t('model.food_sampling_certificate', 'Tuman'),
            'sampling_adress' => Yii::t('model.food_sampling_certificate', 'Namuna olish manzil'),
            'sampler_person_pnfl' => Yii::t('model.food_sampling_certificate', 'JSHSHIR(PNFL)'),
            'sampler_person_inn' => Yii::t('model.food_sampling_certificate', 'STIR(PNFL)'),
            'verification_pupose_id' => Yii::t('model.food_sampling_certificate', 'Namunani tekshirtirishdan maqsad'),
            'sampling_date' => Yii::t('model.food_sampling_certificate', 'Namuna olish sanasi'),
            'send_sample_date' => Yii::t('model.food_sampling_certificate', 'Namuna yuborilgan sana'),
            'based_public_information' => Yii::t('model.food_sampling_certificate', 'Xabar asosida tuzilgan'),
            'explanations' => Yii::t('model.food_sampling_certificate', 'Namunani yuborish sharoiti'),
            'message_number' => Yii::t('model.food_sampling_certificate', 'Xabar raqami'),
            'created' => Yii::t('model.food_sampling_certificate', 'Yaratildi'),
            'updated' => Yii::t('model.food_sampling_certificate', 'O\'zgartirildi'),
            'status_id' => Yii::t('model.food_sampling_certificate', 'Status'),
            'sert_date' => Yii::t('model.food_sampling_certificate', 'Dalolatnoma sanasi'),
            'sert_number' => Yii::t('model.food_sampling_certificate', 'Dalolatnoma raqami(Qog\'ozdagi)'),
            'region' => Yii::t('model.food_sampling_certificate', 'Viloyat'),
            'sampler_name' => Yii::t('model.food_sampling_certificate', 'FIO'),
            'sampler_position' => Yii::t('model.food_sampling_certificate', 'Lavozim'),
        ];
    }

    public function getSamplingSite(){
        return $this->hasOne(VetSites::className(),['id'=>'sampling_site']);
    }
    /**
     * Gets query for [[FoodSamples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodSamples()
    {
        return $this->hasMany(FoodSamples::className(), ['sert_id' => 'id']);
    }

    public function getStatus(){
        return $this->hasOne(SertStatus::className(),['id'=>'status_id']);
    }
    /**
     * Gets query for [[ProductExpertises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductExpertises()
    {
        return $this->hasMany(ProductExpertise::className(), ['food_sampling_certificate' => 'id']);
    }

    /**
     * Gets query for [[VerificationPupose]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerificationPupose()
    {
        return $this->hasOne(VerificationPurposes::className(), ['id' => 'verification_pupose_id']);
    }
    public function getSoato0(){
        return $this->hasOne(Soato::className(),['MHOBT_cod'=>'sampling_soato']);
    }
    public function getInn0(){
        return $this->hasOne(LegalEntities::className(),['inn'=>'inn']);
    }
    public function getPnfl0(){
        return $this->hasOne(Individuals::className(),['pnfl'=>'pnfl']);
    }

    public function getPersonInn(){
        return $this->hasOne(LegalEntities::className(),['inn'=>'sampler_person_inn']);
    }
    public function getPersonPnfl(){
        return $this->hasOne(Individuals::className(),['pnfl'=>'sampler_person_pnfl']);
    }
}
