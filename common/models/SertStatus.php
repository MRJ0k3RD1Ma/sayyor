<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sert_status".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property string $icon
 *
 * @property Sertificates[] $sertificates
 */
class SertStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sert_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru','icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'name_uz' => Yii::t('model', 'Name Uz'),
            'name_ru' => Yii::t('model', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[Sertificates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSertificates()
    {
        return $this->hasMany(Sertificates::className(), ['status_id' => 'id']);
    }
}
