<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emlash".
 *
 * @property int|null $animal_id
 * @property string $antibiotic
 * @property string $emlash_date
 *
 * @property Animals $animal
 */
class Emlash extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emlash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id'], 'integer'],
            [['antibiotic', 'emlash_date'], 'required'],
            [['emlash_date'], 'safe'],
            [['antibiotic'], 'string', 'max' => 255],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animals::className(), 'targetAttribute' => ['animal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => Yii::t('model.emlash', 'Hayvon'),
            'antibiotic' => Yii::t('model.emlash', 'Antibiotik'),
            'emlash_date' => Yii::t('model.emlash', 'Sana'),
        ];
    }

    /**
     * Gets query for [[Animal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animals::className(), ['id' => 'animal_id']);
    }
}
