<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_expertise".
 *
 * @property int $id
 * @property string|null $inn
 * @property int|null $orgaization_id
 * @property int|null $food_sampling_certificate
 * @property int|null $vet_site_id
 * @property int|null $is_urget_test
 * @property int|null $expertise_type 0-bepul, 1-pullik
 * @property string|null $phone
 *
 * @property FoodSamplingCertificate $foodSamplingCertificate
 * @property LegalEntities $inn0
 * @property Organizations $orgaization
 */
class ProductExpertise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_expertise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orgaization_id', 'food_sampling_certificate', 'vet_site_id', 'is_urget_test', 'expertise_type'], 'integer'],
            [['inn', 'pnfl','phone'], 'string', 'max' => 255],
            [['food_sampling_certificate'], 'exist', 'skipOnError' => true, 'targetClass' => FoodSamplingCertificate::className(), 'targetAttribute' => ['food_sampling_certificate' => 'id']],
            [['orgaization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['orgaization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'inn' => Yii::t('model', 'STIR(INN)'),
            'orgaization_id' => Yii::t('model', 'Tashkilot'),
            'food_sampling_certificate' => Yii::t('model', 'Mahsulot ekspertizasi'),
            'vet_site_id' => Yii::t('model', 'Vet uchaska'),
            'is_urget_test' => Yii::t('model', 'Shoshilinch test'),
            'expertise_type' => Yii::t('model', 'Ekspertiza turi'),
            'phone' => Yii::t('model', 'Tel raqami'),
        ];
    }

    /**
     * Gets query for [[FoodSamplingCertificate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodSamplingCertificate()
    {
        return $this->hasOne(FoodSamplingCertificate::className(), ['id' => 'food_sampling_certificate']);
    }

    /**
     * Gets query for [[Inn0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInn0()
    {
        return $this->hasOne(LegalEntities::className(), ['inn' => 'inn']);
    }

    /**
     * Gets query for [[Orgaization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrgaization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'orgaization_id']);
    }
}
