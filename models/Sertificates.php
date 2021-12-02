<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sertificates".
 *
 * @property string $sert_id Тизимдаги далолатнома рақами (автоматик генерация қилинади: ХХ-1-ХХХ-ХХХХХ (йил-далолатнома тури-лаборатория коди-тартиб рақами, масалан: 22-1-001-00001 – 2022 йил-касаллик диагностикаси-республика лабораторияси-2022 йилдаги далолатнома тартиб раками)
 * @property string|null $sert_num Далолатнома рақами (коғоздаги ёки РЕГИСТОНдаги)
 * @property string|null $sert_date
 * @property int|null $organization_id Бу ерда асли стир бўлиши керак.
 * @property string $pnfl
 * @property string|null $owner_name
 * @property int|null $vet_site_id
 * @property int|null $operator
 *
 * @property Employees $operator0
 * @property Organizations $organization
 * @property Individuals $pnfl0
 * @property VetSites $vetSite
 */
class Sertificates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sertificates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sert_id'], 'required'],
            [['sert_date'], 'safe'],
            [['organization_id', 'vet_site_id', 'operator'], 'integer'],
            [['sert_id', 'sert_num'], 'string', 'max' => 100],
            [['pnfl', 'owner_name'], 'string', 'max' => 255],
            [['sert_id'], 'unique'],
            [['operator'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['operator' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sert_id' => Yii::t('model.sertificates', 'Kod'),
            'sert_num' => Yii::t('model.sertificates', 'Raqami'),
            'sert_date' => Yii::t('model.sertificates', 'Sana'),
            'organization_id' => Yii::t('model.sertificates', 'Tashkilot'),
            'pnfl' => Yii::t('model.sertificates', 'PNFL'),
            'owner_name' => Yii::t('model.sertificates', 'Egasi'),
            'vet_site_id' => Yii::t('model.sertificates', 'Vet uchstka'),
            'operator' => Yii::t('model.sertificates', 'Operator'),
        ];
    }

    /**
     * Gets query for [[Operator0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperator0()
    {
        return $this->hasOne(Employees::className(), ['id' => 'operator']);
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organization_id']);
    }

    /**
     * Gets query for [[Pnfl0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPnfl0()
    {
        return $this->hasOne(Individuals::className(), ['pnfl' => 'pnfl']);
    }

    /**
     * Gets query for [[VetSite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVetSite()
    {
        return $this->hasOne(VetSites::className(), ['id' => 'vet_site_id']);
    }
}
