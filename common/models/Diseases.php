<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diseases".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property int|null $category_id
 * @property int|null $group_id
 *
 * @property DiseaseCategory $category
 * @property DiseaseGroups $group
 * @property Vaccination[] $vaccinations
 */
class Diseases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diseases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'group_id'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['vet4'],'string','max'=>3],
            [['vet4','name_uz','name_ru','category_id','group_id'],'required'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => DiseaseGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DiseaseCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.diseases', 'ID'),
            'name_uz' => Yii::t('model.diseases', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.diseases', 'Nomi(Rus)'),
            'category_id' => Yii::t('model.diseases', 'Toifasi'),
            'group_id' => Yii::t('model.diseases', 'Turi'),
            'vet4' => Yii::t('model.diseases', 'Vet4'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(DiseaseCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(DiseaseGroups::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Vaccinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVaccinations()
    {
        return $this->hasMany(Vaccination::className(), ['disease_id' => 'id']);
    }
}
