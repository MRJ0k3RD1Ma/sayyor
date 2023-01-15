<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contragent".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property LegalEntities[] $legalEntities
 */
class Contragent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contragent';
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
            'id' => Yii::t('model', 'ID'),
            'name_uz' => Yii::t('model', 'Name Uz'),
            'name_ru' => Yii::t('model', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[LegalEntities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLegalEntities()
    {
        return $this->hasMany(LegalEntities::className(), ['contragent_id' => 'id']);
    }
}
