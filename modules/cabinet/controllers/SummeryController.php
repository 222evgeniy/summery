<?php
namespace common\modules\summery\modules\cabinet\controllers;

use app\components\Controller;
use common\config\CommonConfigInterface;
use common\modules\summery\SummeryFacade;
use Yii;

/**
 * Class SummeryController
 * @package common\modules\summery\modules\cabinet\controllers
 */
class SummeryController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $url = $_SERVER['REQUEST_URI'];
            Yii::$app->response->redirect(Yii::$app->urlManager->createUrl([
                '/login',
                'city' => '',
                'region' => '',
                'redirect' => $url
            ]));
            return false;
        }
        return parent::beforeAction($action);
    }

    /**
     * @return string
     */
    public function actionIndex() {

        $user = Yii::$app->user->identity;
        $summery = SummeryFacade::getSummeryModelByUserId($user->getId());

        return $this->render('index', [
            'summery' => $summery,
            'user' => $user
        ]);
    }

    /**
     * @param $summery_id
     * @return string
     */
    public function actionGetSummeryBlock($summery_id) {
        $model = SummeryFacade::getSummeryModel($summery_id);
        return $this->renderPartial('summery', [
            'summery' => $model,
        ]);
    }

}