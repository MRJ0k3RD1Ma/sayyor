<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sample_conditions".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $code
 *
 * @property FoodSamplingCertificate[] $foodSamplingCertificates
 */
class SampleConditions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample_conditions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', ], 'required'],
            [['code'], 'integer'],
            [['name_uz'], 'string', 'max' => 100],
            [['name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.sample_conditions', 'ID'),
            'name_uz' => Yii::t('model.sample_conditions', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.sample_conditions', 'Nomi(Rus)'),
            'code' => Yii::t('model.sample_conditions', 'Kod'),
        ];
    }

    /**
     * Gets query for [[FoodSamplingCertificates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodSamplingCertificates()
    {
        return $this->hasMany(FoodSamplingCertificate::className(), ['sample_condition_id' => 'id']);
    }
}
