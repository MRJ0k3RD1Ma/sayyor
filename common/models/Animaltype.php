<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animaltype".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property string $vet4
 * @property int|null $code
 *
 * @property Animals[] $animals
 */
class Animaltype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animaltype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru','vet4'], 'required'],
            [['id', 'code'], 'integer'],
            [['name_uz'], 'string', 'max' => 100],
            [['name_ru'], 'string', 'max' => 255],
            [['vet4'], 'string', 'max' => 2],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.animaltype', 'ID'),
            'name_uz' => Yii::t('model.animaltype', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.animaltype', 'Nomi(Rus)'),
            'code' => Yii::t('model.animaltype', 'Kod'),
            'vet4' => Yii::t('model.animaltype', 'Vet4'),
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
}
