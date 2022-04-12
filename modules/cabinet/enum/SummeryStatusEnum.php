<?php


namespace common\modules\summery\modules\cabinet\enum;


use yii2mod\enum\helpers\BaseEnum;

/**
 * Class SummeryStatusEnum
 * @package common\modules\summery\modules\cabinet\enum
 */
class SummeryStatusEnum extends BaseEnum
{
    const STATUS_LOAD = 1;
    const STATUS_DELETE = 2;

    public static $messageCategory = 'summery';

    public static $list = [
        self::STATUS_LOAD => 'load data',
        self::STATUS_DELETE => 'data delete'
    ];
}