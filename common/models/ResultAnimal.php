<?php

namespace common\models;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use Yii;

/**
 * This is the model class for table "result_animal".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $code_id
 * @property int|null $consent_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $state_id
 * @property int|null $sample_id
 * @property int|null $org_id
 */
class ResultAnimal extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_id', 'org_id','sample_id', 'consent_id',
                'state_id','is_change'], 'integer'],
            [['created', 'updated', 'end_date', ], 'safe'],
            [['code', ], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'code' => Yii::t('model', 'Raqami'),
            'code_id' => Yii::t('model', 'Code ID'),
            'consent_id' => Yii::t('model', 'Tasdiqladi'),
            'created' => Yii::t('model', 'Yaratildi'),
            'updated' => Yii::t('model', 'O\'zgartirildi'),
            'state_id' => Yii::t('model', 'Holati'),
            'org_id' => Yii::t('model', 'Tashkilot'),
            'is_change' => Yii::t('model', 'Normalarni o`zgartirish'),
        ];
    }

    public function getTests(){
        return $this->hasMany(ResultAnimalTests::className(),['result_id'=>'id'])->where(['checked'=>true]);
    }

    public function getSample(){
        return $this->hasOne(Samples::className(),['id'=>'sample_id']);
    }

    public function getOrg(){
        return $this->hasOne(Organizations::className(),['id'=>'org_id']);
    }
}
