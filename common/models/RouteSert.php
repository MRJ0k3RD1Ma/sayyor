<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_sert".
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
 * @property int $sample_type_id
 * @property int $is_group
 *
 * @property Employees $director
 * @property Employees $leader
 * @property SampleRegistration $registration
 * @property Samples $sample
 * @property StateList $state
 * @property RouteStatus $status
 */
class RouteSert extends \yii\db\ActiveRecord
{
    public $temp;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_sert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['director_id','leader_id','sample_type_id'],'required'],
            [['executor_id','deadline',],'required','on'=>'send'],
            ['temp','each','rule'=>['integer']],
            [['director_id', 'leader_id', 'executor_id', 'state_id', 'sample_id', 'registration_id', 'status_id','sample_type_id'], 'integer'],
            [['deadline', 'created', 'updated'], 'safe'],
            [['ads'], 'string', 'max' => 500],
            ['vet4','string','max'=>8],
            ['is_group','integer'],
            [['executor_id','deadline'],'required','on'=>'exec'],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['leader_id' => 'id']],
            [['registration_id'], 'exist', 'skipOnError' => true, 'targetClass' => SampleRegistration::className(), 'targetAttribute' => ['registration_id' => 'id']],
            [['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => Samples::className(), 'targetAttribute' => ['sample_id' => 'id']],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['director_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => StateList::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RouteStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['sample_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SampleTypes::className(), 'targetAttribute' => ['sample_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'temp' => '',
            'director_id' => Yii::t('food', 'Direktor'),
            'leader_id' => Yii::t('food', 'Labaratoriya mudiri'),
            'executor_id' => Yii::t('food', 'Bajaruvchi'),
            'deadline' => Yii::t('food', 'Muddat'),
            'ads' => Yii::t('food', 'Izoh'),
            'state_id' => Yii::t('food', 'Holat'),
            'created' => Yii::t('food', 'Yaratildi'),
            'updated' => Yii::t('food', 'O\'zgartirildi'),
            'sample_id' => Yii::t('food', 'Namuna'),
            'registration_id' => Yii::t('food', 'Ariza'),
            'status_id' => Yii::t('food', 'Status'),
            'vet4' => Yii::t('food', '4vet'),
            'is_group' => Yii::t('food', 'Guruh'),
            'sample_type_id' => Yii::t('food', 'Namuna turi'),
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

    /**
     * Gets query for [[Leader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Employees::className(), ['id' => 'leader_id']);
    }
    public function getExecutor()
    {
        return $this->hasOne(Employees::className(), ['id' => 'executor_id']);
    }
    /**
     * Gets query for [[Registration]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistration()
    {
        return $this->hasOne(SampleRegistration::className(), ['id' => 'registration_id']);
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
    public function getSampleType(){
        return $this->hasOne(SampleTypes::className(),['id'=>'sample_type_id']);
    }
}
