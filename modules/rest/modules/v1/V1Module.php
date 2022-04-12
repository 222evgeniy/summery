<?php

namespace common\modules\summery\modules\rest\modules\v1;

use yii\base\Module;
use yii\web\GroupUrlRule;

/**
 * Class V1Module
 * @package common\modules\summery\modules\rest\modules\v1
 */
class V1Module extends Module
{
    /**
     * @param string $parentId
     * @return array
     */
    public static function getUrlRules(string $parentId): array
    {
        $currentId = "$parentId/v1";

        return [
            'class' => GroupUrlRule::class,
            'prefix' => $currentId,
            'routePrefix' => $currentId,
            'rules' => [
                  'GET summery-info' => "summery-info/view",
                  'GET get-text' => "summery-info/get-text",
                  'GET,HEAD get-info-by-user' => "summery-info/get-by-user",
                  'DELETE delete-safe-file' => "summery-info/delete"
            ],
        ];
    }
}