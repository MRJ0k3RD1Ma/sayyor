<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sample_boxes".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
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
            [[ 'name_uz', 'name_ru'], 'required'],
            [['id', ], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['id', 'name_uz', 'name_ru'], 'unique', 'targetAttribute' => ['id', 'name_uz', 'name_ru']],
            ['id','default','value'=>SampleBoxes::find()->max('id')>0?SampleBoxes::find()->max('id')+1:1],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.sample_boxes', 'ID'),
            'name_uz' => Yii::t('model.sample_boxes', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.sample_boxes', 'Nomi(Rus)'),
            'state' => Yii::t('model.sample_boxes', 'Status'),
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


}
