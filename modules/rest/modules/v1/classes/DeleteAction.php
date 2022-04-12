<?php


namespace common\modules\summery\modules\rest\modules\v1\classes;


use api\models\rpc\SuccessResponse;
use Yii;
use yii\web\ServerErrorHttpException;

/**
 * Class DeleteAction
 * @package common\modules\summery\modules\rest\modules\v1\classes
 */
class DeleteAction extends \yii\rest\DeleteAction
{

    /**
     * Deletes a model.
     * @param mixed $id id of the model to be deleted.
     * @throws ServerErrorHttpException on failure.
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }


        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        Yii::$app->getResponse()->setStatusCode(204);

        return (new SuccessResponse())->getResult();
    }

}
