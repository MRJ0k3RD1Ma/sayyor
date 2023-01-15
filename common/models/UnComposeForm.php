<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animaltype".
 *
 * @property array $id
 */
class UnComposeForm extends \yii\db\ActiveRecord
{
    public $id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'each','rule'=>['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.animaltype', 'Alohida'),
        ];
    }
}
