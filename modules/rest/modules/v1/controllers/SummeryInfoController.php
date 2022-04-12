<?php


namespace common\modules\summery\modules\rest\modules\v1\controllers;


use api\classes\RestBaseController;
use backend\exception\AccesDeniedExeption;
use common\modules\summery\modules\cabinet\models\SummeryModel;
use common\modules\summery\modules\rest\modules\v1\classes\DeleteAction;
use common\modules\summery\modules\rest\modules\v1\classes\LoadFile;
use common\modules\summery\SummeryFacade;
use common\modules\ua_pay\modules\rest\modules\v1\models\HandlerClient;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class SummeryInfoController
 * @package common\modules\summery\modules\rest\modules\v1\controllers
 */
class SummeryInfoController extends RestBaseController
{

    /** @var string  */
    public $modelClass = SummeryModel::class;

    public function init()
    {
        Controller::init();
    }
    /**
     *
     * @SWG\Swagger(
     *     schemes={"https"},
     *     basePath="/api/summery/rest/v1",
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="Besplatka safe deal web API Documentation"
     *     ),
     *     consumes={"application/json"},
     *     produces={"text/html", "application/json", "application/xml"},
     * )
     *
     * @SWG\SecurityScheme(
     *      securityDefinition="bearerAuth",
     *      type="apiKey",
     *      name="Authorization",
     *      in="header"
     * )
     *
     * @SWG\Get(
     *     path="/summery-info?id={id}",
     *     tags={"view summery-info"},
     *     summary="View summery.",
     *     @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        required = true,
     *        type = "integer",
     *    ),
     *     @SWG\Response(
     *         response = 200,
     *         description="Ok",
     *     ),
     *     @SWG\Response(
     *       response="401",
     *       description="Unauthorized"
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )
     * @SWG\Get(
     *     path="/get-info-by-user",
     *     tags={"get-info-by-user summery-info"},
     *     summary="View summery by user_id.",
     *     @SWG\Response(
     *         response = 200,
     *         description="Ok",
     *     ),
     *     @SWG\Response(
     *       response="401",
     *       description="Unauthorized"
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )
     * @SWG\Delete(
     *     path="/delete-safe-file?id={id}",
     *     tags={"delete summery-info"},
     *     summary="Delete Summery by id.",
     *     @SWG\Parameter(
     *        in = "path",
     *        name = "id",
     *        required = true,
     *        type = "integer",
     *    ),
     *     @SWG\Response(
     *         response = 200,
     *         description="Ok",
     *     ),
     *     @SWG\Response(
     *       response="401",
     *       description="Unauthorized"
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )

     *
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel'],
                'checkAccess' => [$this, 'checkAccess']
            ],
            'get_text' => [
                'class' => 'yii\rest\ViewAction',
                'checkAccess' => [$this, 'checkAccess'],
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ]
        ];
    }

    /**
     * @param $summery_id
     * @return SummeryModel
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function findModel($id): SummeryModel
    {
        if (($model = SummeryModel::findOne(['id' => (int)$id])) !== null) {

            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return SummeryModel
     */
    public function findModelUser() {
        return SummeryFacade::getSummeryModelByUserId(Yii::$app->user->id);
    }

    /**
     * @return SummeryModel
     */
    public function actionGetByUser() {

        return $this->findModelUser();
    }

    /**
     * @SWG\GET (
     *     path="/get-text?category_id={$category_id}&user_id={user_id}",
     *     tags={"get-text summery"},
     *     summary="get text Summery.",
     *    @SWG\Parameter  (
     *      in="path",
     *      name="user_id",
     *      required = true,
     *      type="integer"
     *     ),
     *     @SWG\Parameter  (
     *      in="path",
     *      name="category_id",
     *      required = true,
     *      type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description="Ok",
     *     ),
     *     @SWG\Response(
     *       response="401",
     *       description="Unauthorized"
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )
     */
    public function actionGetText(int $category_id, int $user_id) {
        $message = [
            'category_id' => $category_id,
            'user_id' => $user_id
        ];
        return SummeryFacade::getIsWorkText($message);
    }

    /**
     * @param string $action
     * @param null|HandlerClient $model
     * @param array $params
     * @throws AccesDeniedExeption
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (empty($model)) {
            return;
        }

        if ($model->user_id != Yii::$app->user->id) {
            throw new AccesDeniedExeption();
        }
    }

    /**
     * @SWG\Post (
     *     path="/save-file",
     *     tags={"save-file summery"},
     *     summary="save Summery.",
     *     @SWG\Parameter  (
     *      in="body",
     *      name="filename",
     *      required = true,
     *      type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description="Ok",
     *     ),
     *     @SWG\Response(
     *       response="401",
     *       description="Unauthorized"
     *     ),
     *     security={
     *       {"bearerAuth": {}}
     *     }
     * )
     */
    public function actionSaveFile()
    {
        $load = new LoadFile();
        return $load->load();
    }
}