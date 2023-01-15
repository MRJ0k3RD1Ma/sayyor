<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_animal".
 *
 * @property int $id
 * @property int|null $type_id
 * @property int|null $cat_id Kirik olik
 * @property int|null $soato_id
 * @property string|null $lat
 * @property string|null $long
 * @property string|null $detail
 * @property int|null $operator_id
 * @property int|null $is_true
 * @property int|null $report_status_id
 * @property string|null $phone
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $code
 * @property string|null $lang
 * @property string|null $image
 * @property int|null $rep_id
 *
 * @property AnimalCategory $cat
 * @property AnimalCategory $cat0
 * @property ReportStatus $reportStatus
 * @property Soato $soato
 * @property Animaltype $type
 */
class ReportAnimal extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'cat_id', 'soato_id', 'operator_id', 'is_true', 'report_status_id', 'rep_id','organization_id'], 'integer'],
            [['detail'], 'string'],
            [['image'],'each','rule'=>['string']],
            [['created', 'updated'], 'safe'],
            [['lat', 'long', 'phone', 'code','lang'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['report_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportStatus::className(), 'targetAttribute' => ['report_status_id' => 'id']],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato_id' => 'MHOBT_cod']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animaltype::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('report', 'ID'),


            'type_id' => Yii::t('report', 'Hayvon turi'),
            'cat_id' => Yii::t('report', 'Hayvon holat'),
            'soato_id' => Yii::t('report', 'Manzil'),
            'lat' => Yii::t('report', 'Lat'),
            'long' => Yii::t('report', 'Long'),
            'detail' => Yii::t('report', 'Batafsil'),
            'phone' => Yii::t('report', 'Telefon raqami'),


            'operator_id' => Yii::t('report', 'Operator'),
            'is_true' => Yii::t('report', 'Tasdiqdan o\'tgan'),
            'report_status_id' => Yii::t('report', 'Status'),
            'created' => Yii::t('report', 'Created'),
            'updated' => Yii::t('report', 'Updated'),
            'code' => Yii::t('report', 'Code'),
            'rep_id' => Yii::t('report', 'Rep ID'),
            'lang' => Yii::t('report', 'Til'),
            'organization_id' => Yii::t('report', 'Bajaruvchi Labaratoriya'),
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(AnimalCategory::className(), ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[Cat0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat0()
    {
        return $this->hasOne(AnimalCategory::className(), ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[ReportStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReportStatus()
    {
        return $this->hasOne(ReportStatus::className(), ['id' => 'report_status_id']);
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Animaltype::className(), ['id' => 'type_id']);
    }

    public function getStatus(){
        return $this->hasOne(ReportStatus::className(),['id'=>'report_status_id']);
    }

    public function getOperator(){
        return $this->hasOne(Employees::className(),['id'=>'operator_id']);
    }
}
