<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vaccines".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Vaccination[] $vaccinations
 */
class Vaccines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vaccines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.vaccines', 'ID'),
            'name' => Yii::t('model.vaccines', 'Nomi'),
        ];
    }

    /**
     * Gets query for [[Vaccinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVaccinations()
    {
        return $this->hasMany(Vaccination::className(), ['vaccina_id' => 'id']);
    }
}
