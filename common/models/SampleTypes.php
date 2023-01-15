<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sample_types".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property Samples[] $samples
 * @property StatusList $state0
 */
class SampleTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vet4','name_uz', 'name_ru'], 'required'],
            [['id'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['vet4'],'string','max'=>3],
            [['id'], 'unique'],
            [['id', 'name_uz', 'name_ru'], 'unique', 'targetAttribute' => ['id', 'name_uz', 'name_ru']],
            ['id','default','value'=>SampleTypes::find()->max('id')>0?SampleTypes::find()->max('id')+1:1],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.sample_types', 'ID'),
            'name_uz' => Yii::t('model.sample_types', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.sample_types', 'Nomi(Rus)'),
            'vet4' => Yii::t('model.sample_types', 'Vet4'),
        ];
    }

    /**
     * Gets query for [[Samples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Samples::className(), ['sample_type_is' => 'id']);
    }

}
