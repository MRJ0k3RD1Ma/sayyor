<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "individuals".
 *
 * @property string $pnfl
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $middlename
 * @property int|null $soato_id
 * @property string|null $adress
 * @property string|null $passport
 *
 * @property Soato $soato
 */
class Individuals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'individuals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pnfl'], 'required'],
            [['soato_id'], 'integer'],
            [['pnfl', 'name', 'surname', 'middlename', 'adress', 'passport'], 'string', 'max' => 255],
            [['pnfl'], 'unique'],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato_id' => 'MHOBT_cod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pnfl' => Yii::t('model.individuals', 'PNFL'),
            'name' => Yii::t('model.individuals', 'Ism'),
            'surname' => Yii::t('model.individuals', 'Familya'),
            'middlename' => Yii::t('model.individuals', 'Otasining ismi'),
            'soato_id' => Yii::t('model.individuals', 'QFY'),
            'adress' => Yii::t('model.individuals', 'Manzil'),
            'passport' => Yii::t('model.individuals', 'Pasport'),
        ];
    }

    /**
     * Gets query for [[Soato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato()
    {
        return $this->hasOne(Soato::className(), ['MHOBT_cod' => 'soato_id']);
    }
}
