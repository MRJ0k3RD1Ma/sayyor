<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "disease_category".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property Diseases[] $diseases
 */
class DiseaseCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disease_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'required'],
            [['id'], 'integer'],
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
            'id' => Yii::t('model.disease_category', 'ID'),
            'name_uz' => Yii::t('model.disease_category', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.disease_category', 'Nomi(Rus)'),
        ];
    }

    /**
     * Gets query for [[Diseases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiseases()
    {
        return $this->hasMany(Diseases::className(), ['category_id' => 'id']);
    }
}
