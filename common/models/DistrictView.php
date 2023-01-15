<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district_view".
 *
 * @property int $MHOBT_cod
 * @property int|null $region_id
 * @property int|null $district_id
 * @property string|null $name_lot
 * @property string|null $center_lot
 * @property string|null $name_cyr
 * @property string|null $center_cyr
 * @property string|null $name_ru
 * @property string|null $center_ru
 */
class DistrictView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MHOBT_cod'], 'required'],
            [['MHOBT_cod', 'region_id', 'district_id'], 'integer'],
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
            'MHOBT_cod' => Yii::t('model.districtview', 'MHOBT Kod'),
            'region_id' => Yii::t('model.districtview', 'Viloyat'),
            'district_id' => Yii::t('model.districtview', 'Tuman'),
            'name_lot' => Yii::t('model.districtview', 'Nomi(Lotin)'),
            'center_lot' => Yii::t('model.districtview', 'Markaz(Lotin)'),
            'name_cyr' => Yii::t('model.districtview', 'Nomi(Kiril)'),
            'center_cyr' => Yii::t('model.districtview', 'Markaz(Kiril)'),
            'name_ru' => Yii::t('model.districtview', 'Nomi(Rus)'),
            'center_ru' => Yii::t('model.districtview', 'Markaz(Rus)'),
        ];
    }
}
