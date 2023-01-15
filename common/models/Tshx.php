<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tshx".
 *
 * @property int|null $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property int|null $code
 */
class Tshx extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tshx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            ['id','default','value'=>Tshx::find()->max('id')>0?Tshx::find()->max('id')+1:1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.tshx', 'ID'),
            'name_uz' => Yii::t('model.tshx', 'Nomi(O\'zbek)'),
            'name_ru' => Yii::t('model.tshx', 'Nomi(Rus)'),
            'code' => Yii::t('model.tshx', 'Kod'),
        ];
    }
}
