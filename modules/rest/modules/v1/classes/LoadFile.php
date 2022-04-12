<?php


namespace common\modules\summery\modules\rest\modules\v1\classes;

use common\modules\summery\modules\cabinet\enum\SummeryStatusEnum;
use common\modules\summery\modules\cabinet\models\SummeryModel;
use common\modules\summery\SummeryFacade;
use frontend\classes\users\UserSummeryAttachments;
use Yii;
use yii\base\BaseObject;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

/**
 * Class LoadFile
 * @package common\modules\summery\modules\rest\modules\v1\classes
 */
class LoadFile extends BaseObject
{
    /** @var string  */
    public $modelName = 'SummeryModel';

    public function load()
    {
        $user = Yii::$app->user->identity;
        $model = $this->findOne($user->id);
        $post = Yii::$app->getRequest()->getBodyParams();

        $data[$this->modelName] = $post;

        /**@var ActiveRecord $model */
        $model->load($data);

        if ($model->validate()) {

            $data = $this->upload('filename');
            $data = array_merge($data, ['old' => $model->getOldAttribute('filename')]);

            $model->url = $data['name'];

            $loader = new UserSummeryAttachments();
            $loader->setUserInfo($user->info);
            $loader->setAvatarQueueJob($data);

            $model->status = SummeryStatusEnum::STATUS_LOAD;

            $model->save();

//            $response = Yii::$app->getResponse();
//            $response->setStatusCode(201);
//            $id = implode(',', array_values($model->getPrimaryKey(true)));
//            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));

            //TODO:: Model send Creat AT as Expression
            $model = SummeryFacade::getSummeryModel($model->id);

        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }

    /**
     * @param $type
     * @return array|string[]
     */
    protected function upload($type) {

        try {
            $sid = md5(microtime(true));

            $tmp = $this->prepareDir($sid);
            $directory = $tmp['dir'];

            $fileinfo = current($_FILES);

            $filename = substr(md5(microtime(true)), 20) . "." . pathinfo($fileinfo['name'],
                    PATHINFO_EXTENSION);

            move_uploaded_file($fileinfo['tmp_name'], $directory . $filename);

            $res = [
                'error' => '',
                'name' => $filename,
                'url' => $directory . $filename,
            ];

        } catch (\Exception $e) {
            $res = [
                'error' => $e->getMessage()
            ];
        }
        return $res;
    }

    /**
     * @param $sid
     * @return string[]
     */
    protected function prepareDir($sid) {

        $img_path = Yii::getAlias('@uploads');

        $directory = $img_path . "/tmp/" . $sid . "/";

        if ($img_path . "/tmp//" == $directory || $img_path . "/tmp/" == $img_path . "/tmp//") {
            Yii::warning('Uploadfile directory: ' . $directory);
        }

        if (!file_exists($directory)) {
            mkdir($directory, 0777);
        }

        return ['url'=>'/uploads/tmp/' . $sid . "/", 'dir' => $directory];
    }

    protected function findOne(int $user_id) :SummeryModel {
        $model = SummeryModel::find()->where(['user_id' => $user_id])->one();
        if(empty($model)) {
            $model = new SummeryModel();
        }
        return  $model;
    }
}