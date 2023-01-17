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
            [['is_another'], 'exist', 'skipOnError' => true, 'targetClass' => Diseases::class, 'targetAttribute' => ['is_another' => 'id']],
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
            'sample_id' => 'Sample ID',
            'route_id' => 'Route ID',
            'result_id' => 'Result ID',
            'end_date' => 'End Date',
            'temprature' => 'Temprature',
            'humidity' => 'Humidity',
            'reagent_name' => 'Reagent Name',
            'reagent_series' => 'Reagent Series',
            'conditions' => 'Conditions',
            'ads' => 'Ads',
            'created' => 'Created',
            'updated' => 'Updated',
            'state_id' => 'State ID',
            'patonomiya' => 'Patonomiya',
            'organoleptika' => 'Organoleptika',
            'mikroskopiya_nurli' => 'Mikroskopiya Nurli',
            'mikroskopiya_lyuminesent' => 'Mikroskopiya Lyuminesent',
            'bakterilogik' => 'Bakterilogik',
            'virusologik_TE_KE' => 'Virusologik Te Ke',
            'virusologik_XM_KK' => 'Virusologik Xm Kk',
            'biologik' => 'Biologik',
            'RA_KR' => 'Ra Kr',
            'RSK' => 'Rsk',
            'RDSK' => 'Rdsk',
            'RBP' => 'Rbp',
            'RMA' => 'Rma',
            'RP_RDP' => 'Rp Rdp',
            'RH' => 'Rh',
            'RNGA' => 'Rnga',
            'RGKA' => 'Rgka',
            'RGA' => 'Rga',
            'IFA' => 'Ifa',
            'IXLA' => 'Ixla',
            'boshqa_serologiya' => 'Boshqa Serologiya',
            'PSR' => 'Psr',
            'gistologiya' => 'Gistologiya',
            'gemotologiya' => 'Gemotologiya',
            'koprologiya' => 'Koprologiya',
            'kimyoviy' => 'Kimyoviy',
            'biokimyoviy' => 'Biokimyoviy',
            'is_change' => 'Is Change',
            'why_change' => 'Why Change',
            'is_another' => 'Is Another',
            'another_disease_id' => 'Another Disease ID',
        ];
    }

    /**
     * Gets query for [[IsAnother]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIsAnother()
    {
        return $this->hasOne(Diseases::class, ['id' => 'is_another']);
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
