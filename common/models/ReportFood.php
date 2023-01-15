<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_food".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $rep_id
 * @property int|null $food_id
 * @property int|null $cat_id
 * @property string|null $lat
 * @property string|null $long
 * @property int|null $soato_id
 * @property string|null $phone
 * @property string|null $detail
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $is_true
 * @property int|null $status_id
 *
 * @property ReportFoodCategory $cat
 * @property Soato $soato
 * @property ReportStatus $status
 * @property Food $food
 */
class ReportFood extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rep_id', 'food_id', 'cat_id','operator_id', 'soato_id', 'is_true', 'status_id'], 'integer'],
            [['detail'], 'string'],
            ['image','each','rule'=>['string']],
            [['created', 'updated'], 'safe'],
            [['code', 'lat', 'long', 'phone'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato_id' => 'MHOBT_cod']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('report', 'ID'),
            'food_id' => Yii::t('report', 'Mahsulot turi'),
            'cat_id' => Yii::t('report', 'Holat'),
            'soato_id' => Yii::t('report', 'Manzil'),
            'lat' => Yii::t('report', 'Lat'),
            'long' => Yii::t('report', 'Long'),
            'detail' => Yii::t('report', 'Batafsil'),
            'phone' => Yii::t('report', 'Telefon raqami'),
            'code' => Yii::t('food', 'Code'),
            'rep_id' => Yii::t('food', 'Rep ID'),
            'created' => Yii::t('food', 'Created'),
            'updated' => Yii::t('food', 'Updated'),
            'operator_id' => Yii::t('report', 'Operator'),
            'is_true' => Yii::t('report', 'Tasdiqdan o\'tgan'),
            'status_id' => Yii::t('report', 'Status'),
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(FoodCategory::className(), ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[Soato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato()
    {
        return $this->hasOne(Soato::className(), ['MHOBT_cod' => 'soato_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ReportStatus::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }
}
