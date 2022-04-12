<?php


namespace common\modules\summery\modules\cabinet\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\User;

/**
 * Class SummeryModel
 * @package common\modules\summery\modules\cabinet\models
 * @property string $filename
 * @property int $user_id
 * @property int $status
 * @property string $create_at
 * @property string $url
 */
class SummeryModel extends ActiveRecord
{
    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'create_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%summery}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'user_id'], 'required'],
            [['user_id', 'filename','create_at','status', 'url'], 'safe'],
            ['create_at', 'date','format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}