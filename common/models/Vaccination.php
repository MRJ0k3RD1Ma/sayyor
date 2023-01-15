<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vaccination".
 *
 * @property int $animal_id
 * @property int|null $vaccina_id
 * @property int|null $disease_id
 * @property string|null $disease_date
 *
 * @property Animals $animal
 * @property Diseases $disease
 * @property Vaccines $vaccina
 */
class Vaccination extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vaccination';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'disease_id'], 'required'],
            [['animal_id', 'vaccina_id', 'disease_id'], 'integer'],
            [['disease_date'], 'safe'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animals::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['disease_id'], 'exist', 'skipOnError' => true, 'targetClass' => Diseases::className(), 'targetAttribute' => ['disease_id' => 'id']],
//            [['vaccina_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vaccines::className(), 'targetAttribute' => ['vaccina_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => Yii::t('model.roles', 'Animal ID'),
            'vaccina_id' => Yii::t('model.roles', 'Vaccina ID'),
            'disease_id' => Yii::t('model.roles', 'Disease ID'),
            'disease_date' => Yii::t('model.roles', 'Disease Date'),
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

    /**
     * Gets query for [[Disease]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisease()
    {
        return $this->hasOne(Diseases::className(), ['id' => 'disease_id']);
    }

    /**
     * Gets query for [[Vaccina]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVaccina()
    {
        return $this->hasOne(Vaccines::className(), ['id' => 'vaccina_id']);
    }
}
