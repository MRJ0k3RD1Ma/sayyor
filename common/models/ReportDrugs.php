<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_drugs".
 *
 * @property int $id
 * @property int|null $rep_id
 * @property string|null $code
 * @property int|null $cat_id
 * @property int|null $type_id
 * @property int|null $soato_id
 * @property string|null $lat
 * @property string|null $long
 * @property string|null $detail
 * @property string|null $phone
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $operator_id
 * @property int|null $is_true
 * @property int|null $status_id
 *
 * @property ReportFoodCategory $cat
 * @property Soato $soato
 * @property ReportStatus $status
 * @property ReportDrugType $type
 */
class ReportDrugs extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_drugs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rep_id', 'cat_id', 'type_id', 'soato_id', 'operator_id', 'is_true', 'status_id'], 'integer'],
            [['detail'], 'string'],
            ['image','each','rule'=>['string']],
            [['created', 'updated'], 'safe'],
            [['code', 'lat', 'long', 'phone'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportFoodCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato_id' => 'MHOBT_cod']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportDrugType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'rep_id' => Yii::t('food', 'Rep ID'),
            'code' => Yii::t('food', 'Raqami'),
            'cat_id' => Yii::t('food', 'Kategoriya'),
            'type_id' => Yii::t('food', 'Turi'),
            'soato_id' => Yii::t('food', 'Manzil'),
            'lat' => Yii::t('food', 'Lat'),
            'long' => Yii::t('food', 'Long'),
            'detail' => Yii::t('food', 'Batafsil'),
            'phone' => Yii::t('food', 'Telefon'),
            'created' => Yii::t('food', 'Yuborildi'),
            'updated' => Yii::t('food', 'Tekshirildi'),
            'operator_id' => Yii::t('food', 'Operator'),
            'is_true' => Yii::t('food', 'Haqqoniyligi'),
            'status_id' => Yii::t('food', 'Holati'),
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(ReportFoodCategory::className(), ['id' => 'cat_id']);
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ReportDrugType::className(), ['id' => 'type_id']);
    }
}
