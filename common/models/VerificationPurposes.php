<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "verification_purposes".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $code
 *
 * @property FoodSamplingCertificate[] $foodSamplingCertificates
 */
class VerificationPurposes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verification_purposes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name_uz', 'name_ru', 'code'], 'required'],
            [['id', 'code'], 'integer'],
            [['name_uz'], 'string', 'max' => 100],
            [['name_ru'], 'string', 'max' => 255],
            [['id'], 'unique'],
            ['id','default','value'=>VerificationPurposes::find()->max('id')>0?VerificationPurposes::find()->max('id')+1:1],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.verification_purposes', 'ID'),
            'name_uz' => Yii::t('model.verification_purposes', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.verification_purposes', 'Nomi(Rus)'),
            'code' => Yii::t('model.verification_purposes', 'Kod'),
        ];
    }

    /**
     * Gets query for [[FoodSamplingCertificates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodSamplingCertificates()
    {
        return $this->hasMany(FoodSamplingCertificate::className(), ['verification_pupose_id' => 'id']);
    }
}
