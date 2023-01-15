<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regions_view".
 *
 * @property int|null $region_id
 * @property string|null $name_lot
 * @property string|null $center_lot
 * @property string|null $name_cyr
 * @property string|null $center_cyr
 * @property string|null $name_ru
 * @property string|null $center_ru
 */
class RegionsView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['name_lot', 'name_cyr', 'name_ru'], 'string', 'max' => 100],
            [['center_lot', 'center_cyr', 'center_ru'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => Yii::t('model.regionsview', 'Viloyat'),
            'name_lot' => Yii::t('model.regionsview', 'Nomi(Lotin)'),
            'center_lot' => Yii::t('model.regionsview', 'Markaz'),
            'name_cyr' => Yii::t('model.regionsview', 'Nomi(Kril)'),
            'center_cyr' => Yii::t('model.regionsview', 'Markaz(Kril)'),
            'name_ru' => Yii::t('model.regionsview', 'Nomi(Rus)'),
            'center_ru' => Yii::t('model.regionsview', 'Markaz(Rus)'),
        ];
    }
}
