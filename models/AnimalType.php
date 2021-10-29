<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal_type".
 *
 * @property int $id
 * @property string $name
 * @property int $cat_id
 *
 * @property Animals[] $animals
 * @property AnimalCategory $cat
 */
class AnimalType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cat_id'], 'required'],
            [['cat_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
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
            'cat_id' => Yii::t('app', 'Cat ID'),
        ];
    }

    /**
     * Gets query for [[Animals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animals::className(), ['type_id' => 'id']);
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(AnimalCategory::className(), ['id' => 'cat_id']);
    }
}
