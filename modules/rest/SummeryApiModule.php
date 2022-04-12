<?php


namespace common\modules\summery\modules\rest;

use common\modules\summery\modules\rest\modules\v1\V1Module;
use yii\base\Module as YiiModule;
use yii\web\GroupUrlRule;

/**
 * Class SummeryApiModule
 * @package common\modules\summery\modules\rest
 */
class SummeryApiModule extends YiiModule
{
    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->setModules([
            'v1' => ['class' => V1Module::class],
        ]);

        parent::init();
    }

    /**
     * @param string $parentId
     * @return array
     */
    public static function getUrlRules(string $parentId): array
    {
        $currentId = "$parentId/rest";

        $data = [
            'class' => GroupUrlRule::class,
            'prefix' => $currentId,
            'routePrefix' => $currentId,
            'rules' => V1Module::getUrlRules($currentId),
        ];

        return $data;
    }
}