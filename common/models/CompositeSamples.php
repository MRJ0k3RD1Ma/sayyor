<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "composite_samples".
 *
 * @property int $id
 * @property int|null $sample_id
 * @property int|null $status_id
 * @property int|null $sample_status_id
 * @property int|null $registration_id
 * @property string|null $ads
 *
 * @property Samples $sample
 * @property SampleRegistration[] $sampleRegistrations
 */
class CompositeSamples extends \yii\db\ActiveRecord
{
    public $is_group;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'composite_samples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sample_id','is_group', 'status_id','sample_status_id','registration_id'], 'integer'],
            ['ads','string','max'=>500],
            [['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => Samples::className(), 'targetAttribute' => ['sample_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sample_id' => 'Namuna',
            'status_id' => 'Status',
            'sample_status_id' => 'Namuna holati',
            'ads' => 'Izoh',
            'is_group' => 'Birlashgan namunalardan',
        ];
    }

    public function getSampleStatus(){
        return $this->hasOne(SampleStatus::className(),['id'=>'sample_status_id']);
    }
    /**
     * Gets query for [[Sample]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSample()
    {
        return $this->hasOne(Samples::className(), ['id' => 'sample_id']);
    }

    /**
     * Gets query for [[SampleRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSampleRegistrations()
    {
        return $this->hasMany(SampleRegistration::className(), ['registration_id' => 'id']);
    }
}
