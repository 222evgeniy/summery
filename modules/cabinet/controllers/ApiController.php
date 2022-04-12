<?php


namespace common\modules\summery\modules\cabinet\controllers;

use common\modules\summery\modules\cabinet\enum\SummeryStatusEnum;
use common\modules\summery\modules\rest\modules\v1\classes\LoadFile;
use common\modules\summery\SummeryFacade;
use frontend\classes\users\UserSummeryAttachments;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

/**
 * Class ApiController
 * @package common\modules\summery\modules\cabinet\controllers
 */
class ApiController extends Controller
{
    /**
     * @return array|array[]|bool[]|\string[][][][][]|AccessControl[]
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'save-file',
                            'get-summery-block',
                            'save-file-api',
                        ],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'save-file',
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

    /**
     * @return array
     */
    protected function verbs()
    {
        return [
            'save-file' => ['POST'],
            'save-file-api' => ['POST'],
        ];
    }

    /**
     * @return array|bool
     * @throws \yii\base\InvalidRouteException
     * @throws \yii\console\Exception
     */
    public function actionSaveFile() {
        $user = Yii::$app->user->identity;
        $post = Yii::$app->request->post();

        $summery = SummeryFacade::getSummeryModelByUserId($user->id);

        if($summery->load($post) && $summery->validate()) {

            $data = Yii::$app->runAction('attachment/upload-shop',['type' => 'filename', 'form_name' => 'SummeryModel']);

            $data = array_merge($data, ['old' => $summery->getOldAttribute('filename')]);

            $summery->url = $data['name'];

            $loader = new UserSummeryAttachments();
            $loader->setUserInfo($user->info);
            $loader->setAvatarQueueJob($data);

            $summery->status = SummeryStatusEnum::STATUS_LOAD;

            $res = $summery->save();
        } else {
            $res = $summery->errors;
        }
        return $res;
    }

    public function actionSaveFileApi() {
        $load = new LoadFile();
        return $load->load();
    }
}