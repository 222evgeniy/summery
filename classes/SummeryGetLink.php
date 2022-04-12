<?php

namespace common\modules\summery\classes;

use common\modules\summery\modules\cabinet\models\SummeryModel;
use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\web\Linkable;
use yii\web\User;

/**
 * Class SummeryGetLink
 * @package common\modules\summery\classes
 */
class SummeryGetLink extends BaseObject implements Linkable
{
    /** @var SummeryModel */
    public $summery;

    /** @var User */
    public $user;

    /**
     * @return array
     */
    public function getLinks()
    {
        return [
            Html::a($this->summery->filename ,Yii::$app->urlManager->createAbsoluteUrl(Yii::$app->params['protocol'] . \Yii::$app->params['bucket'] . '/summery/' . $this->user->id . '/' . $this->summery->filename))
        ];
    }

}