<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goverments".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int|null $code
 *
 * @property EmpPosts[] $empPosts
 */
class Goverments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goverments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'required'],
            [['id', 'code'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['id', 'name_uz', 'name_ru'], 'unique', 'targetAttribute' => ['id', 'name_uz', 'name_ru']],
            ['id','default','value'=>Goverments::find()->max('id')>0?Goverments::find()->max('id')+1:1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('gov', 'ID'),
            'name_uz' => Yii::t('gov', 'Nomi(UZ)'),
            'name_ru' => Yii::t('gov', 'Nomi(RU)'),
            'code' => Yii::t('gov', 'Code'),
        ];
    }

    /**
     * Gets query for [[EmpPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpPosts()
    {
        return $this->hasMany(EmpPosts::className(), ['gov_id' => 'id']);
    }
}
