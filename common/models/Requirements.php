<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requirements".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru

 * @property ResultFood[] $resultFoods
 */
class Requirements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requirements';
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
            'name_uz' => Yii::t('model', 'Nomi(UZ)'),
            'name_ru' => Yii::t('model', 'Nomi(RU)'),
        ];
    }

    /**
     * Gets query for [[ResultFoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultFoods()
    {
        return $this->hasMany(ResultFood::className(), ['require_id' => 'id']);
    }

}
