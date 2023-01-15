<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "laboratory_test_type".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $code
 *
 * @property FoodSamplingCertificate[] $foodSamplingCertificates
 */
class LaboratoryTestType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laboratory_test_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', ], 'required'],
            [['id', 'code'], 'integer'],
            [['name_uz'], 'string', 'max' => 100],
            [['name_ru'], 'string', 'max' => 255],
            [['id'], 'unique'],
            ['id','default','value'=>LaboratoryTestType::find()->max('id')>0?LaboratoryTestType::find()->max('id')+1:1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.laboratory_test_type', 'ID'),
            'name_uz' => Yii::t('model.laboratory_test_type', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.laboratory_test_type', 'Nomi(Rus)'),
            'code' => Yii::t('model.laboratory_test_type', 'Kod'),
        ];
    }

    /**
     * Gets query for [[FoodSamplingCertificates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodSamplingCertificates()
    {
        return $this->hasMany(FoodSamplingCertificate::className(), ['laboratory_test_type_id' => 'id']);
    }
}
