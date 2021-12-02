<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "samples".
 *
 * @property int $id
 * @property string|null $kod
 * @property string|null $label
 * @property int|null $sample_type_is
 * @property int|null $sample_box_id
 * @property int|null $animal_id
 * @property int|null $sert_id
 *
 * @property Animals $animal
 * @property SampleBoxes $sampleBox
 * @property SampleTypes $sampleTypeIs
 * @property Sertificates $sert
 */
class Samples extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'samples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sample_type_is', 'sample_box_id', 'animal_id', 'sert_id'], 'integer'],
            [['kod', 'label'], 'string', 'max' => 255],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animals::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['sample_box_id'], 'exist', 'skipOnError' => true, 'targetClass' => SampleBoxes::className(), 'targetAttribute' => ['sample_box_id' => 'id']],
            [['sample_type_is'], 'exist', 'skipOnError' => true, 'targetClass' => SampleTypes::className(), 'targetAttribute' => ['sample_type_is' => 'id']],
            [['sert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sertificates::className(), 'targetAttribute' => ['sert_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.samples', 'ID'),
            'kod' => Yii::t('model.samples', 'Kod'),
            'label' => Yii::t('model.samples', 'Label'),
            'sample_type_is' => Yii::t('model.samples', 'Sample Type Is'),
            'sample_box_id' => Yii::t('model.samples', 'Sample Box ID'),
            'animal_id' => Yii::t('model.samples', 'Animal ID'),
            'sert_id' => Yii::t('model.samples', 'Sert ID'),
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
     * Gets query for [[SampleBox]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSampleBox()
    {
        return $this->hasOne(SampleBoxes::className(), ['id' => 'sample_box_id']);
    }

    /**
     * Gets query for [[SampleTypeIs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSampleTypeIs()
    {
        return $this->hasOne(SampleTypes::className(), ['id' => 'sample_type_is']);
    }

    /**
     * Gets query for [[Sert]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSert()
    {
        return $this->hasOne(Sertificates::className(), ['id' => 'sert_id']);
    }
}
