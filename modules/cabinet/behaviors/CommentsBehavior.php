<?php

namespace common\modules\summery\modules\cabinet\behaviors;

use common\modules\summery\modules\cabinet\models\SummeryCommentModel;
use frontend\models\CommentsNew;
use yii\base\Behavior;
use yii\di\Instance;

/**
 * Class CommentsBehavior
 * @package common\modules\summery\modules\cabinet\behaviors
 */
class CommentsBehavior extends Behavior
{
    /**
     * @param \yii\base\Component $owner
     * @throws \yii\base\InvalidConfigException
     */
    public function attach($owner)
    {
        $owner = Instance::ensure($owner, CommentsNew::class);
        parent::attach($owner);
    }

    /**
     * @return mixed
     */
    public function getLinks() {
        return $this->owner->hasOne(SummeryCommentModel::class, ['comment_id' => 'id']);
    }

}