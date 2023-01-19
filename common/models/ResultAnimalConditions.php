<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "result_animal_conditions".
 *
 * @property int $sample_id
 * @property int $route_id
 * @property int $result_id
 * @property string|null $end_date
 * @property int|null $temprature
 * @property int|null $humidity
 * @property string|null $reagent_name
 * @property string|null $reagent_series
 * @property string|null $conditions
 * @property string|null $ads
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $state_id
 * @property int $patonomiya
 * @property int $organoleptika
 * @property int $mikroskopiya_nurli
 * @property int $mikroskopiya_lyuminesent
 * @property int $bakterilogik
 * @property int $virusologik_TE_KE
 * @property int $virusologik_XM_KK
 * @property int $biologik
 * @property int $RA_KR
 * @property int $RSK
 * @property int $RDSK
 * @property int $RBP
 * @property int $RMA
 * @property int $RP_RDP
 * @property int $RH
 * @property int $RNGA
 * @property int $RGKA
 * @property int $RGA
 * @property int $IFA
 * @property int $IXLA
 * @property int $boshqa_serologiya
 * @property int $PSR
 * @property int $gistologiya
 * @property int $gemotologiya
 * @property int $koprologiya
 * @property int $kimyoviy
 * @property int $biokimyoviy
 * @property int $is_change
 * @property string|null $why_change
 * @property int $is_another
 * @property int|null $another_disease_id
 *
 * @property Diseases $isAnother
 * @property ResultAnimal $result
 * @property RouteSert $route
 * @property Samples $sample
 */
class ResultAnimalConditions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_animal_conditions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sample_id', 'route_id', 'result_id'], 'required'],
            [['sample_id', 'route_id', 'result_id', 'temprature', 'humidity', 'state_id', 'patonomiya', 'organoleptika', 'mikroskopiya_nurli', 'mikroskopiya_lyuminesent', 'bakterilogik', 'virusologik_TE_KE', 'virusologik_XM_KK', 'biologik', 'RA_KR', 'RSK', 'RDSK', 'RBP', 'RMA', 'RP_RDP', 'RH', 'RNGA', 'RGKA', 'RGA', 'IFA', 'IXLA', 'boshqa_serologiya', 'PSR', 'gistologiya', 'gemotologiya', 'koprologiya', 'kimyoviy', 'biokimyoviy', 'is_change', 'is_another', 'another_disease_id'], 'integer'],
            [['end_date', 'created', 'updated'], 'safe'],
            [['conditions', 'why_change'], 'string'],
            [['reagent_name', 'reagent_series', 'ads'], 'string', 'max' => 255],
            [['sample_id', 'route_id', 'result_id'], 'unique', 'targetAttribute' => ['sample_id', 'route_id', 'result_id']],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResultAnimal::class, 'targetAttribute' => ['result_id' => 'id']],
            [['route_id'], 'exist', 'skipOnError' => true, 'targetClass' => RouteSert::class, 'targetAttribute' => ['route_id' => 'id']],
            [['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => Samples::class, 'targetAttribute' => ['sample_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sample_id' => 'Namuna',
            'route_id' => 'Route',
            'result_id' => 'Result ID',
            'temprature' => Yii::t('model', 'Xona tempraturasi'),
            'humidity' => Yii::t('model', 'Xona namligi'),
            'reagent_name' => Yii::t('model', 'Reaktiv nomi'),
            'reagent_series' => Yii::t('model', 'Reaktiv seriyasi'),
            'conditions' => Yii::t('model', 'Boshqa sharoitlar'),
            'end_date' => Yii::t('model', 'Test tugash vaqti'),
            'ads' => Yii::t('model', 'Umumlashgan natija'),
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'state_id' => 'State ID',
            'patonomiya' => Yii::t('model', 'Patonomiya'),
            'organoleptika' => Yii::t('model', 'Organoleptika'),
            'mikroskopiya_nurli' => Yii::t('model', 'Mikroskopiya Nurli'),
            'mikroskopiya_lyuminesent' => Yii::t('model', 'Mikroskopiya Lyuminesent'),
            'bakterilogik' => Yii::t('model', 'Bakterilogik'),
            'virusologik_TE_KE' => Yii::t('model', 'Virusologik TE,KE'),
            'virusologik_XM_KK' => Yii::t('model', 'Virusologik XM,KK'),
            'biologik' => Yii::t('model', 'Biologik'),
            'RA_KR' => Yii::t('model', 'RA,KR'),
            'RSK' => Yii::t('model', 'RSK'),
            'RDSK' => Yii::t('model', 'RDSK'),
            'RBP' => Yii::t('model', 'RBP'),
            'RMA' => Yii::t('model', 'RMA'),
            'RP_RDP' => Yii::t('model', 'RP,RDP'),
            'RH' => Yii::t('model', 'RH'),
            'RNGA' => Yii::t('model', 'RNGA'),
            'RGKA' => Yii::t('model', 'RGKA'),
            'RGA' => Yii::t('model', 'RGA'),
            'IFA' => Yii::t('model', 'IFA'),
            'IXLA' => Yii::t('model', 'IXLA'),
            'boshqa_serologiya' => Yii::t('model', 'Boshqa Serologiya'),
            'PSR' => Yii::t('model', 'PSR'),
            'gistologiya' => Yii::t('model', 'Gistologiya'),
            'gemotologiya' => Yii::t('model', 'Gemotologiya'),
            'koprologiya' => Yii::t('model', 'Koprologiya'),
            'kimyoviy' => Yii::t('model', 'Kimyoviy'),
            'biokimyoviy' => Yii::t('model', 'Biokimyoviy'),
            'another_disease_id' => Yii::t('model', 'Aniqlangan kasallik nomi'),
            'is_another' => Yii::t('model', 'Boshqa kasallik aniqlandi'),
            'is_change' => Yii::t('model', 'Normalarni o`zgartirish'),
            'why_change' => Yii::t('model', 'Sababi'),
        ];
    }

    /**
     * Gets query for [[Result]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(ResultAnimal::class, ['id' => 'result_id']);
    }

    /**
     * Gets query for [[Route]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(RouteSert::class, ['id' => 'route_id']);
    }

    /**
     * Gets query for [[Sample]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSample()
    {
        return $this->hasOne(Samples::class, ['id' => 'sample_id']);
    }
}
