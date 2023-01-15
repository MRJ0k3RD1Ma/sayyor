<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sertificate_application".
 *
 * @property int $id
 * @property string|null $code Kod
 * @property string|null $pnfl PNFL
 * @property string|null $inn STIR(INN)
 * @property int|null $fsc_id food_sampling_certificate
 * @property int|null $vet_site_id Vet uchastka
 * @property int|null $labaratory_test_type_id Nazorat turi
 * @property int|null $emergency_check Shoshilinch tekshirish
 * @property int|null $cat_id Tekshiruv kategoriyasi
 * @property int|null $phone Arizachi telefoni
 * @property int|null $name Arizani to\'ldirgan shaxs
 * @property int|null $check_date Ariza to\'ldirilgan sana
 * @property int|null $status Status
 *
 * @property FoodSamplingCertificate $fsc
 * @property LaboratoryTestType $labaratoryTestType
 * @property StatusList $status0
 */
class SertificateApplication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sertificate_application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fsc_id', 'vet_site_id', 'labaratory_test_type_id', 'emergency_check', 'cat_id', 'status'], 'integer'],
            [['code', 'pnfl', 'inn','phone', 'name',], 'string', 'max' => 255],
            [ 'check_date', 'safe'],
            [['fsc_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodSamplingCertificate::className(), 'targetAttribute' => ['fsc_id' => 'id']],
            [['labaratory_test_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => LaboratoryTestType::className(), 'targetAttribute' => ['labaratory_test_type_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusList::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.sertificate_application', 'ID'),
            'code' => Yii::t('model.sertificate_application', 'Kod'),
            'pnfl' => Yii::t('model.sertificate_application', 'PNFL'),
            'inn' => Yii::t('model.sertificate_application', 'STIR(INN)'),
            'fsc_id' => Yii::t('model.sertificate_application', 'Namuna olish dalolatnomasi raqami'),
            'vet_site_id' => Yii::t('model.sertificate_application', 'Vet uchastka'),
            'labaratory_test_type_id' => Yii::t('model.sertificate_application', 'Nazorat turi'),
            'emergency_check' => Yii::t('model.sertificate_application', 'Shoshilinch tekshirish'),
            'cat_id' => Yii::t('model.sertificate_application', 'Tekshirish kategoriyasi'),
            'phone' => Yii::t('model.sertificate_application', 'Arizachi raqami'),
            'name' => Yii::t('model.sertificate_application', 'Ariza to\'ldiruvchi nomi'),
            'check_date' => Yii::t('model.sertificate_application', 'Yuborilgan sana'),
            'status' => Yii::t('model.sertificate_application', 'Status'),
        ];
    }

    /**
     * Gets query for [[Fsc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFsc()
    {
        return $this->hasOne(FoodSamplingCertificate::className(), ['id' => 'fsc_id']);
    }

    /**
     * Gets query for [[LabaratoryTestType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLabaratoryTestType()
    {
        return $this->hasOne(LaboratoryTestType::className(), ['id' => 'labaratory_test_type_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(StatusList::className(), ['id' => 'status']);
    }

}
