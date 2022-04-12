<?php


namespace common\modules\summery;


use common\modules\summery\classes\SummeryIsWorkClasses;
use common\modules\summery\classes\SummeryIsWorkForApi;
use common\modules\summery\modules\cabinet\models\SummeryModel;
use common\modules\summery\modules\cabinet\services\SummeryProvider;
use common\modules\ua_pay\classes\UaPayApiProvider;
use yii\base\Component;

/**
 * Class SummeryDomain
 * @package common\modules\summery
 */
class SummeryDomain extends Component
{
    /** @var SummeryProvider */
    protected $provider;

    /**
     * SummeryDomain constructor.
     * @param SummeryProvider $provider
     * @param array $config
     */
    public function __construct(SummeryProvider $provider, $config = [])
    {
        $this->provider = $provider;
        parent::__construct($config);
    }

    /**
     * @return UaPayApiProvider
     */
    public function getSummeryProvider(): SummeryProvider
    {
        return $this->provider;
    }

    /**
     * @param int $id
     * @return SummeryModel|null
     * @throws \yii\web\NotFoundHttpException
     */
    public function getSummeryModel(int $id) :?SummeryModel {

        return $this->provider->findModel($id);
    }

    /**
     * @param $user_id
     * @return SummeryModel|null
     */
    public function getSummeryModelByUserId($user_id) :?SummeryModel {
        return $this->provider->findModelByUserId($user_id);
    }

    /**
     * @param $message
     * @return array
     */
    public static function getIsWorkData($message): array {
        return (new SummeryIsWorkClasses($message))->getResult();
    }

    /**
     * @param $message
     * @return array
     * @throws \yii\web\HttpException
     */
    public static function getIsWorkText($message): array {
        return (new SummeryIsWorkForApi($message))->getResult();
    }

}