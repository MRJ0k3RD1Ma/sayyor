<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animals".
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 * @property int $color_id
 * @property int $gender_id
 *
 * @property AnimalColor $color
 * @property AnimalGender $gender
 * @property AnimalType $type
 */
class Animals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_id', 'color_id', 'gender_id'], 'required'],
            [['type_id', 'color_id', 'gender_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalColor::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalGender::className(), 'targetAttribute' => ['gender_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => Yii::t('app', 'Type ID'),
            'color_id' => Yii::t('app', 'Color ID'),
            'gender_id' => Yii::t('app', 'Gender ID'),
        ];
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(AnimalColor::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(AnimalGender::className(), ['id' => 'gender_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AnimalType::className(), ['id' => 'type_id']);
    }
}
