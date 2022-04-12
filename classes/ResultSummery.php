<?php


namespace common\modules\summery\classes;

use yii\base\BaseObject;
use yii\web\Linkable;

/**
 * Class ResultSummery
 * @package common\modules\summery\classes
 */
class ResultSummery extends BaseObject
{
    /** @var bool */
    public $is_work = false;
    /** @var string  */
    public $text_with = '';
    /** @var string  */
    public $text_not_with = '';
    /** @var int */
    public $summery_id;
    /** @var Linkable */
    public $link;
    /** @var string */
    public $filename = '';

}