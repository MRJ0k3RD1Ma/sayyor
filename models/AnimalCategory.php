<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal_category".
 *
 * @property int $id
 * @property string $name
 *
 * @property AnimalType[] $animalTypes
 */
class AnimalCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Gets query for [[AnimalTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalTypes()
    {
        return $this->hasMany(AnimalType::className(), ['cat_id' => 'id']);
    }
}
