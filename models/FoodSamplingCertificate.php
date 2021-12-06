<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_sampling_certificate".
 *
 * @property int $id
 * @property string|null $kod
 * @property string|null $pnfl
 * @property string|null $inn
 * @property int|null $sampling_site
 * @property string|null $sampling_adress
 * @property int|null $sampler_organization_code
 * @property int|null $sampler_person_pnfl
 * @property int|null $unit_id
 * @property float|null $count
 * @property int|null $verification_sample
 * @property string|null $producer
 * @property string|null $serial_num
 * @property string|null $manufacture_date
 * @property string|null $sell_by
 * @property string|null $coments
 * @property int|null $verification_pupose_id
 * @property int|null $sampling_rules_id
 * @property int|null $sample_condition_id
 * @property string|null $sampling_date
 * @property string|null $send_sample_date
 * @property string|null $explanations
 */
class FoodSamplingCertificate extends \yii\db\ActiveRecord
{
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
            [['sampling_site', 'sampler_organization_code', 'sampler_person_pnfl', 'unit_id', 'verification_sample', 'verification_pupose_id', 'sampling_rules_id', 'sample_condition_id'], 'integer'],
            [['count'], 'number'],
            [['manufacture_date', 'sell_by', 'sampling_date', 'send_sample_date'], 'safe'],
            [['kod', 'pnfl', 'inn', 'sampling_adress', 'producer', 'serial_num', 'coments', 'explanations'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.food_sampling_certificate', 'ID'),
            'kod' => Yii::t('model.food_sampling_certificate', 'Kod'),
            'pnfl' => Yii::t('model.food_sampling_certificate', 'PNFL'),
            'inn' => Yii::t('model.food_sampling_certificate', 'INN'),
            'sampling_site' => Yii::t('model.food_sampling_certificate', 'Vet uchastka'),
            'sampling_adress' => Yii::t('model.food_sampling_certificate', 'Vet uchastka manzili'),
            'sampler_organization_code' => Yii::t('model.food_sampling_certificate', 'Namuna topshiruvchi tashkilot'),
            'sampler_person_pnfl' => Yii::t('model.food_sampling_certificate', 'Namuna topshiruvchi fuqaro'),
            'unit_id' => Yii::t('model.food_sampling_certificate', 'Birlik'),
            'count' => Yii::t('model.food_sampling_certificate', 'Soni'),
            'verification_sample' => Yii::t('model.food_sampling_certificate', 'Verification Sample'),
            'producer' => Yii::t('model.food_sampling_certificate', 'Ishlab chiqaruvchi'),
            'serial_num' => Yii::t('model.food_sampling_certificate', 'Seriya raqami'),
            'manufacture_date' => Yii::t('model.food_sampling_certificate', 'Ishlab chiqarilgan sana'),
            'sell_by' => Yii::t('model.food_sampling_certificate', 'Yaroqlilik muddati'),
            'coments' => Yii::t('model.food_sampling_certificate', 'Izoh'),
            'verification_pupose_id' => Yii::t('model.food_sampling_certificate', 'Tekshirishdan maqsad'),
            'sampling_rules_id' => Yii::t('model.food_sampling_certificate', 'Namuna olish qoidasi'),
            'sample_condition_id' => Yii::t('model.food_sampling_certificate', 'Labaratoriya tadqiqot turi'),
            'sampling_date' => Yii::t('model.food_sampling_certificate', 'Namuna olish vaqti'),
            'send_sample_date' => Yii::t('model.food_sampling_certificate', 'Namuna yuborilgan sana'),
            'explanations' => Yii::t('model.food_sampling_certificate', 'Namunalarni saqlash va yuborish sharoiti'),
        ];
    }
}
