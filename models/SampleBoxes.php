<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sample_boxes".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $state
 *
 * @property Samples[] $samples
 * @property StatusList $state0
 */
class SampleBoxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample_boxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name_uz', 'name_ru'], 'required'],
            [['id', 'state'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['id', 'name_uz', 'name_ru'], 'unique', 'targetAttribute' => ['id', 'name_uz', 'name_ru']],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => StatusList::className(), 'targetAttribute' => ['state' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.sample_boxes', 'ID'),
            'name_uz' => Yii::t('model.sample_boxes', 'Name Uz'),
            'name_ru' => Yii::t('model.sample_boxes', 'Name Ru'),
            'state' => Yii::t('model.sample_boxes', 'State'),
        ];
    }

    /**
     * Gets query for [[Samples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Samples::className(), ['sample_box_id' => 'id']);
    }

    /**
     * Gets query for [[State0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(StatusList::className(), ['id' => 'state']);
    }
}
