<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "destruction_sample_food".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $code_id
 * @property int|null $sample_id
 * @property string|null $destruction_date
 * @property string|null $ads
 * @property int|null $creator_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $consent_id
 * @property string|null $approved_date
 * @property int|null $state_id
 * @property int|null $org_id
 *
 * @property Employees $consent
 * @property Organizations $org
 * @property FoodSamples $sample
 * @property StateList $state
 */
class DestructionSampleFood extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'destruction_sample_food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_id', 'sample_id', 'creator_id', 'consent_id', 'state_id', 'org_id'], 'integer'],
            [['destruction_date', 'created', 'updated', 'approved_date'], 'safe'],
            [['code', 'ads'], 'string', 'max' => 255],
            [['consent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['consent_id' => 'id']],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['org_id' => 'id']],
            [['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodSamples::className(), 'targetAttribute' => ['sample_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => StateList::className(), 'targetAttribute' => ['state_id' => 'id']],
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
            'code_id' => Yii::t('model', 'Raqami'),
            'sample_id' => Yii::t('model', 'Namuna'),
            'destruction_date' => Yii::t('model', 'Namuna yo\'q qilingan sana'),
            'ads' => Yii::t('model', 'Izoh'),
            'creator_id' => Yii::t('model', 'Labarant'),
            'created' => Yii::t('model', 'Yaratildi'),
            'updated' => Yii::t('model', 'O\'zgartirildi'),
            'consent_id' => Yii::t('model', 'Tasdiqladi'),
            'approved_date' => Yii::t('model', 'Yuborilgan sana'),
            'state_id' => Yii::t('model', 'Holat'),
            'org_id' => Yii::t('model', 'Tashkilot'),
        ];
    }

    /**
     * Gets query for [[Consent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsent()
    {
        return $this->hasOne(Employees::className(), ['id' => 'consent_id']);
    }
    public function getCreator()
    {
        return $this->hasOne(Employees::className(), ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Org]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'org_id']);
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
}
