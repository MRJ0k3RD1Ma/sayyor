<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sert_normatives".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property Sertificates[] $sertificates
 */
class SertNormatives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sert_normatives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('normatives', 'ID'),
            'name_uz' => Yii::t('normatives', 'Name Uz'),
            'name_ru' => Yii::t('normatives', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[Sertificates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSertificates()
    {
        return $this->hasMany(Sertificates::className(), ['nd_id' => 'id']);
    }
}
