<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emp_posts_history".
 *
 * @property int|null $emp_id
 * @property int|null $post_id
 * @property string|null $date Лавозими ёки статуси ўзгарган вақти. 
 * @property int|null $state_id Ходимнинг холати. Актив, ноактив
 * @property int|null $status_id Лавозим статуси :  асосий лавозим, вақтинчалик вазифасини бажарувчи, ва ҳ.к.
 * @property int|null $org_id
 */
class EmpPostsHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emp_posts_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'post_id', 'state_id', 'status_id', 'org_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => Yii::t('app', 'Emp ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'date' => Yii::t('app', 'Date'),
            'state_id' => Yii::t('app', 'State ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'org_id' => Yii::t('app', 'Org ID'),
        ];
    }
}
