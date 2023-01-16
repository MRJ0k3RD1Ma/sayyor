<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "result_animal_tests".
 *
 * @property int $id
 * @property int $result
 * @property int|null $result_2
 * @property int|null $type_id
 * @property int|null $template_id
 * @property int|null $result_id
 * @property int|null $checked
 * @property int|null $change_unit_id
 * @property int|null $route_id
 *
 * @property ResultAnimal $result0
 * @property TamplateAnimal $template
 * @property TemplateUnitType $type
 */
class ResultAnimalTests extends \yii\db\ActiveRecord
{
    public $true1,$true2,$mm_1,$mm_2,$r_son,$r_bool,$r_text,$r_1,$r_2,$r_unit;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_animal_tests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['result'], 'required'],
            [['result', 'result_2',],'string','max'=>255],
            [[ 'type_id','result_type_id', 'template_id','mm_1','mm_2', 'result_id','checked','is_change','change_unit_id','true1','true2'], 'integer'],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResultAnimal::className(), 'targetAttribute' => ['result_id' => 'id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => TamplateAnimal::className(), 'targetAttribute' => ['template_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateUnitType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['ch_min1','ch_min2','ch_max1','ch_max2'],'string','max'=>255],
            [['r_son','r_bool','r_1','r_2','r_unit'],'string'],
            ['r_text','string','max'=>'255'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'result' => Yii::t('model', 'Natija'),
            'result_2' => Yii::t('model', 'Natija'),
            'type_id' => Yii::t('model', 'Turi'),
            'template_id' => Yii::t('model', 'Shablon'),
            'is_change' => Yii::t('model', 'O`zgartirish'),
            'change_unit_id' => Yii::t('model', 'Natija birligi'),
            'ch_min1' => Yii::t('model', 'Min'),
            'true1' => Yii::t('model', 'Min'),
            'ch_min2' => Yii::t('model', 'Min 2'),
            'true2' => Yii::t('model', 'Max'),
            'ch_max1' => Yii::t('model', 'Max'),
            'ch_max2' => Yii::t('model', 'Max 2'),
            'result_id' => Yii::t('model', 'Natija'),
            'result_type_id' => Yii::t('model', 'Moslik'),
            'r_son'=>'Natija',
            'r_bool'=>'Natija',
            'r_1'=>'Natija 1',
            'r_2'=>'Natija 2',
            'r_unit'=>'Natija',
            'r_text'=>'Natija'
        ];
    }

    /**
     * Gets query for [[Result0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResult0()
    {
        return $this->hasOne(ResultAnimal::className(), ['id' => 'result_id']);
    }

    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(TamplateAnimal::className(), ['id' => 'template_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TemplateUnitType::className(), ['id' => 'type_id']);
    }

    public function getResultType(){
        return $this->hasOne(ResultType::className(),['id'=>'result_type_id']);
    }
    public function getUnit(){
        return $this->hasOne(TemplateUnit::className(),['id'=>'change_unit_id']);
    }
    public function getRoute(){
        return $this->hasOne(RouteSert::class,['id'=>'route_id']);
    }
}
