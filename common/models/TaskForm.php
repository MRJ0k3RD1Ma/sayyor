<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "animals".
 *
 * @property int $id
 * @property int $executor_id
 * @property string $deadline
 * @property string|null $ads

 */
class TaskForm extends Model
{
    public $id,$executor_id,$deadline,$ads;
    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deadline','executor_id'],'required'],
            [['id'], 'each','rule'=>['integer']],
            ['executor_id','integer'],
            [['deadline','ads'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'=>'',
            'executor_id'=>'Bajaruvchi',
            'ads'=>'Izoh',
            'deadline'=>'Muddat',
        ];
    }

}
