<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "result_food_conditions".
 *
 * @property int $sample_id
 * @property int $route_id
 * @property int $result_id
 * @property string|null $ads
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $organoleptik
 * @property int|null $mikroskopik
 * @property int|null $mikrobiologik
 * @property int|null $kimyoviy
 * @property int|null $radiologik
 * @property string|null $temprature
 * @property string|null $humidity
 * @property string|null $reagent_name
 * @property string|null $reagent_series
 * @property string|null $conditions
 * @property string|null $end_date
 * @property int $is_change
 * @property string|null $why_change
 */
class ResultFoodConditions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_food_conditions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sample_id', 'route_id', 'result_id'], 'required'],
            [['sample_id', 'route_id', 'result_id', 'organoleptik', 'mikroskopik', 'mikrobiologik', 'kimyoviy', 'radiologik', 'is_change'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['ads', 'temprature', 'humidity', 'reagent_name', 'reagent_series', 'conditions', 'end_date', 'why_change'], 'string', 'max' => 255],
            [['sample_id', 'route_id', 'result_id'], 'unique', 'targetAttribute' => ['sample_id', 'route_id', 'result_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'route_id' => 'Route ID',
            'result_id' => 'Result ID',
            'ads' => Yii::t('model', 'Umumlashgan natija'),
            'sample_id' => Yii::t('model', 'Namuna'),
            'created' => Yii::t('model', 'Yaratilgan'),
            'updated' => Yii::t('model', 'O\'zgartirilgan'),
            'org_id' => Yii::t('model', 'Tashkilot'),
            'radiologik' => Yii::t('model', 'radiologik'),
            'kimyoviy' => Yii::t('model', 'kimyoviy'),
            'mikrobiologik' => Yii::t('model', 'mikrobiologik'),
            'mikroskopik' => Yii::t('model', 'mikroskopik'),
            'organoleptik' => Yii::t('model', 'organoleptik'),
            'temprature' => Yii::t('model', 'Xona tempraturasi'),
            'humidity' => Yii::t('model', 'Xona namligi'),
            'reagent_name' => Yii::t('model', 'Reaktiv nomi'),
            'reagent_series' => Yii::t('model', 'Reaktiv seriyasi'),
            'conditions' => Yii::t('model', 'Boshqa sharoitlar'),
            'end_date' => Yii::t('model', 'Test tugash vaqti'),
            'is_change' => Yii::t('model', 'Normalarni o`zgartirish'),
            'why_change' => Yii::t('model', 'Sababi'),
        ];
    }


    public function getCreator(){
        return $this->hasOne(Employees::class,['id'=>'creator_id']);
    }

    public function getRoute(){
        return $this->hasOne(FoodRoute::class,['id'=>'route_id']);
    }
}
