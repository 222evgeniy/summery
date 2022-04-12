<?php


namespace common\modules\summery\api\controllers;


use api\classes\RestBaseController;
use common\modules\summery\modules\rest\modules\v1\classes\LoadFile;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class ApiController extends RestBaseController
{
    public $modelClass = '';

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'save-file-api',
                        ],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'save-file-api',
                        ],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
                'only' => ['save-file-api'],
                'optional' => ['save-file-api']
            ],
        ]);
    }

    public function actionSaveFileApi() {
        $load = new LoadFile();
        return $load->load();
    }
}