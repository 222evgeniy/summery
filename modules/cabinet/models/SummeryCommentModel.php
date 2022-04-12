<?php

namespace common\modules\summery\modules\cabinet\models;

use yii\db\ActiveRecord;

/**
 * Class SummeryCommentModel
 * @package common\modules\summery\modules\cabinet\models
 * @property int $summery_id
 * @property int $comment_id
 * @property string $url
 * @property string $filename
 *
 */
class SummeryCommentModel extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%summery_comment_link}}';
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            [['summery_id', 'comment_id', 'url', 'filename'], 'safe']
        ];
    }

}