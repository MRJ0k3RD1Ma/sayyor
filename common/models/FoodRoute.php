<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_route".
 *
 * @property int $id
 * @property int|null $director_id
 * @property int|null $leader_id
 * @property int|null $executor_id
 * @property string|null $deadline
 * @property string|null $ads
 * @property int|null $state_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $sample_id
 * @property int|null $registration_id
 * @property int|null $status_id
 * @property int|null $is_group
 *
 * @property Employees $director
 * @property Employees $leader
 * @property FoodRegistration $registration
 * @property FoodSamples $sample
 * @property StateList $state
 * @property SertStatus $status
 */
class FoodRoute extends \yii\db\ActiveRecord
{
    public $temp;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_route';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['director_id', 'leader_id',],'required'],
            [['executor_id','deadline',],'required','on'=>'send'],
            [['director_id', 'leader_id', 'executor_id', 'state_id', 'sample_id', 'registration_id', 'status_id', 'sample_type_id'], 'integer'],
            [['deadline', 'created', 'updated'], 'safe'],
            [['ads',], 'string', 'max' => 255],
            [['is_group',],'integer'],
            ['temp','each','rule'=>['integer']],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['director_id' => 'id']],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['leader_id' => 'id']],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodRegistration::className(), 'targetAttribute' => ['registration_id' => 'id']],
            [['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodSamples::className(), 'targetAttribute' => ['sample_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => StateList::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SertStatus::className(), 'targetAttribute' => ['status_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'director_id' => Yii::t('model', 'Direktor'),
            'leader_id' => Yii::t('model', 'Labaratoriya mudir'),
            'executor_id' => Yii::t('model', 'Bajaruvchi'),
            'deadline' => Yii::t('model', 'Muddat'),
            'ads' => Yii::t('model', 'Izoh'),
            'state_id' => Yii::t('model', 'Holat'),
            'created' => Yii::t('model', 'Yaratildi'),
            'updated' => Yii::t('model', 'O\'zgartirildi'),
            'sample_id' => Yii::t('model', 'Namuna raqami'),
            'registration_id' => Yii::t('model', 'Ariza raqami'),
            'status_id' => Yii::t('model', 'Holati'),
            'temp'=>'',

        ];
    }

    /**
     * Gets query for [[Director]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {
        return $this->hasOne(Employees::className(), ['id' => 'director_id']);
    }

    public function getExecutor()
    {
        return $this->hasOne(Employees::className(), ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Leader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Employees::className(), ['id' => 'leader_id']);
    }

    /**
     * Gets query for [[Registration]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistration()
    {
        return $this->hasOne(FoodRegistration::className(), ['id' => 'registration_id']);
    }

    /**
     * Gets query for [[Sample]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSample()
    {
        return $this->hasOne(FoodSamples::className(), ['id' => 'sample_id']);
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(StateList::className(), ['id' => 'state_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(RouteStatus::className(), ['id' => 'status_id']);
    }
    public function getSampleType()
    {
        return $this->hasOne(SampleTypes::className(), ['id' => 'sample_type_id']);
    }
}
