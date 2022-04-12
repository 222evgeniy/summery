<?php


namespace common\modules\summery;


use common\classes\facade\Facade;
use common\modules\summery\modules\cabinet\models\SummeryModel;

/**
 * Class SummeryFacade
 * @package common\modules\summery
 *
 * @method static SummeryModel getSummeryModel(int $id): SummeryModel
 * @see SummeryDomain::getSummeryModel;
 *
 * @method static SummeryModel getSummeryModelByUserId(int $user_id): SummeryModel
 * @see SummeryDomain::getSummeryModelByUserId;
 *
 * @method static array getIsWorkData(array $message)
 * @see SummeryDomain::getIsWorkData
 *
 *  @method static array getIsWorkText(array $message)
 * @see SummeryDomain::getIsWorkText
 */
class SummeryFacade extends Facade
{
    /**
     * @inheritdoc
     */
    public static function getFacadeAccessor() {
        return 'summeryDomain';
    }
}