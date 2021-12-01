<?php

namespace app\models;

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
 *
 * @property AnimalCategory $cat
 * @property Animaltype $type
 * @property Vaccination[] $vaccinations
 * @property VetSites $vetSite
 */
class Animals extends \yii\db\ActiveRecord
{
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
            [['name', 'cat_id'], 'required'],
            [['cat_id', 'gender', 'vet_site_id', 'type_id'], 'integer'],
            [['birthday'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['inn', 'pnfl', 'adress', 'bsual_tag'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnimalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
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
            'name' => Yii::t('model.animals', 'Name'),
            'cat_id' => Yii::t('model.animals', 'Cat ID'),
            'gender' => Yii::t('model.animals', 'Gender'),
            'birthday' => Yii::t('model.animals', 'Birthday'),
            'inn' => Yii::t('model.animals', 'Inn'),
            'pnfl' => Yii::t('model.animals', 'Pnfl'),
            'adress' => Yii::t('model.animals', 'Adress'),
            'vet_site_id' => Yii::t('model.animals', 'Vet Site ID'),
            'bsual_tag' => Yii::t('model.animals', 'Bsual Tag'),
            'type_id' => Yii::t('model.animals', 'Type ID'),
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
