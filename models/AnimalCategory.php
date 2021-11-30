<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal_category".
 *
 * @property int $id
 * @property int $code
 * @property string $name_uz
 * @property string|null $name_ru
 *
 * @property Animals[] $animals
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
            [['id', 'code', 'name_uz'], 'required'],
            [['id', 'code'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.animal', 'ID'),
            'code' => Yii::t('model.animal', 'Kod'),
            'name_uz' => Yii::t('model.animal', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.animal', 'Nomi(Rus)'),
        ];
    }

    /**
     * Gets query for [[Animals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animals::className(), ['cat_id' => 'id']);
    }
}
