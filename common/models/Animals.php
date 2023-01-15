<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animals".
 *
 * @property int $id
 * @property string $name
 * @property int $cat_id
 * @property int|null $gender
 * @property string|null $birthday
 * @property string|null $inn
 * @property string|null $pnfl
 * @property string|null $adress
 * @property int|null $vet_site_id
 * @property string|null $bsual_tag
 * @property int|null $type_id
 * @property int|null $region
 * @property int|null $district
 *
 * @property AnimalCategory $cat
 * @property Animaltype $type
 * @property Vaccination[] $vaccinations
 * @property VetSites $vetSite
 */
class Animals extends \yii\db\ActiveRecord
{
    public $region,$district,$ownertype;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','type_id','cat_id','birthday','vet_site_id','adress',], 'required'],
            [['cat_id', 'gender','ownertype', 'vet_site_id', 'type_id'], 'integer'],
            [['birthday'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['inn', 'pnfl', 'adress', 'bsual_tag'], 'string', 'max' => 255],
//            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animaltype::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['vet_site_id'], 'exist', 'skipOnError' => true, 'targetClass' => VetSites::className(), 'targetAttribute' => ['vet_site_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.animals', 'ID'),
            'name' => Yii::t('model.animals', 'Egasi'),
            'cat_id' => Yii::t('model.animals', 'Hayvon holati'),
            'gender' => Yii::t('model.animals', 'Jinsi'),
            'birthday' => Yii::t('model.animals', 'Tug\'ilgan kuni'),
            'inn' => Yii::t('model.animals', 'INN(STIR)'),
            'pnfl' => Yii::t('model.animals', 'PNFL'),
            'adress' => Yii::t('model.animals', 'Manzil'),
            'vet_site_id' => Yii::t('model.animals', 'Vet uchastka'),
            'bsual_tag' => Yii::t('model.animals', 'Visual birka'),
            'type_id' => Yii::t('model.animals', 'Hayvon turi'),
            'region' => Yii::t('model.animals', 'Viloyat'),
            'district' => Yii::t('model.animals', 'Tuman'),
            'ownertype' => Yii::t('model.animals', 'Hayvon egasi'),
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Animaltype::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Vaccinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVaccinations()
    {
        return $this->hasMany(Vaccination::className(), ['animal_id' => 'id']);
    }

    public function getEmlash(){
        return $this->hasMany(Emlash::className(),['animal_id'=>'id']);
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
