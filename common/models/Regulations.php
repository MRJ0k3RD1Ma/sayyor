<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "regulation".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $file
 * @property int|null $creator_id
 * @property int|null $status
 * @property int|null $type_id
 * @property string $created
 * @property string|null $updated
 *
 * @property Employees $creator
 * @property StatusList $status0
 * @property TemplateAnimalRegulations[] $templateAnimalRegulations
 * @property TamplateAnimal[] $templates
 */
class Regulations extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regulations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'status','type_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name_uz', 'name_ru','file'], 'string', 'max' => 255],
            [['file'],'file'],
            ['creator_id','default','value'=>Yii::$app->user->id],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusList::className(), 'targetAttribute' => ['status' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegulationTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.food_sampling_certificate', 'ID'),
            'name_uz' => Yii::t('model.food_sampling_certificate', 'Nomi(UZ)'),
            'name_ru' => Yii::t('model.food_sampling_certificate', 'Nomi(RU)'),
            'file' => Yii::t('model.food_sampling_certificate', 'Fayl'),
            'creator_id' => Yii::t('model.food_sampling_certificate', 'Kirituvchi'),
            'status' => Yii::t('model.food_sampling_certificate', 'Status'),
            'created' => Yii::t('model.food_sampling_certificate', 'Kiritildi'),
            'updated' => Yii::t('model.food_sampling_certificate', 'O\'zgartirildi'),
            'type_id' => Yii::t('model.food_sampling_certificate', 'Turi'),
        ];
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Employees::className(), ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(StatusList::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[TemplateAnimalRegulations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateAnimalRegulations()
    {
        return $this->hasMany(TemplateAnimalRegulations::className(), ['regulation_id' => 'id']);
    }

    public function getType(){
        return $this->hasOne(RegulationTypes::className(),['id'=>'type_id']);
    }

    /**
     * Gets query for [[Templates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplates()
    {
        return $this->hasMany(TamplateAnimal::className(), ['id' => 'template_id'])->viaTable('template_animal_regulations', ['regulation_id' => 'id']);
    }
}
