<?php

namespace common\models;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use Yii;

/**
 * This is the model class for table "result_animal".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $code_id
 * @property int|null $temprature
 * @property int|null $humidity
 * @property string|null $reagent_name
 * @property string|null $reagent_series
 * @property string|null $conditions
 * @property string|null $end_date
 * @property string|null $ads
 * @property int|null $creator_id
 * @property int|null $consent_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $state_id
 * @property int|null $sample_id
 * @property int|null $org_id
 * * @property int $patonomiya
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
 */
class ResultAnimal extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_id', 'temprature','org_id','sample_id','humidity', 'creator_id', 'consent_id',
                'state_id','patonomiya', 'organoleptika', 'mikroskopiya_nurli', 'mikroskopiya_lyuminesent',
                'bakterilogik', 'virusologik_TE_KE', 'virusologik_XM_KK', 'biologik', 'RA_KR', 'RSK', 'RDSK',
                'RBP', 'RMA', 'RP_RDP', 'RH', 'RNGA','RGKA', 'RGA', 'IFA', 'IXLA', 'boshqa_serologiya', 'PSR', 'gistologiya',
                'gemotologiya', 'koprologiya', 'kimyoviy', 'biokimyoviy','is_change','is_another','another_disease_id'], 'integer'],
            [['conditions','why_change'], 'string'],
            [['temprature','humidity'],'required','on'=>'lab'],
            [['created', 'updated', 'end_date', ], 'safe'],
            [['code', 'reagent_name', 'reagent_series','ads'], 'string', 'max' => 255],
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
            'code_id' => Yii::t('model', 'Code ID'),
            'temprature' => Yii::t('model', 'Xona tempraturasi'),
            'humidity' => Yii::t('model', 'Xona namligi'),
            'reagent_name' => Yii::t('model', 'Reaktiv nomi'),
            'reagent_series' => Yii::t('model', 'Reaktiv seriyasi'),
            'conditions' => Yii::t('model', 'Boshqa sharoitlar'),
            'end_date' => Yii::t('model', 'Test tugash vaqti'),
            'ads' => Yii::t('model', 'Umumlashgan natija'),
            'creator_id' => Yii::t('model', 'Labarant'),
            'consent_id' => Yii::t('model', 'Tasdiqladi'),
            'created' => Yii::t('model', 'Yaratildi'),
            'updated' => Yii::t('model', 'O\'zgartirildi'),
            'state_id' => Yii::t('model', 'Holati'),
            'org_id' => Yii::t('model', 'Tashkilot'),
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

    public function getTests(){
        return $this->hasMany(ResultAnimalTests::className(),['result_id'=>'id'])->where(['checked'=>true]);
    }

    public function getSample(){
        return $this->hasOne(Samples::className(),['id'=>'sample_id']);
    }

    public function getOrg(){
        return $this->hasOne(Organizations::className(),['id'=>'org_id']);
    }
}
