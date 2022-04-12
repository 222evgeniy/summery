<?php


namespace common\modules\summery\modules\cabinet\behaviors;

use common\models\User;
use common\modules\summery\modules\cabinet\models\SummeryModel;
use yii\base\Behavior;
use yii\di\Instance;

/**
 * Class SummeryBehavior
 * @package common\modules\summery\modules\cabinet\behaviors
 */
class SummeryBehavior extends Behavior
{

    /**
     * @param \yii\base\Component $owner
     * @throws \yii\base\InvalidConfigException
     */
    public function attach($owner)
    {
        $owner = Instance::ensure($owner, User::class);
        parent::attach($owner);
    }

    /**
     * @return mixed
     */
    public function getSummery() {
        return $this->owner->hasOne(SummeryModel::class, ['user_id' => 'id']);
    }

}