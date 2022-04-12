<?php


namespace common\modules\summery\modules\cabinet\services;


use common\modules\summery\modules\cabinet\models\SummeryModel;
use yii\base\BaseObject;

/**
 * Class SummeryProvider
 * @package common\modules\summery\modules\cabinet\services
 */
class SummeryProvider extends BaseObject
{
    /** @var SummeryModel */
    protected $model;

    /**
     * SummeryProvider constructor.
     * @param SummeryModel $model
     * @param array $config
     */
    public function __construct(SummeryModel $model, $config = [])
    {
       $this->model = $model;

       parent::__construct($config);
    }

    /**
     * @param $id
     * @return SummeryModel|null
     */
    public function findModel($id) :?SummeryModel {

        if(($model = $this->model->findOne($id)) !== null) {
            return  $model;
        } else {
            return  $this->model;
        }
    }

    /**
     * @param int $user_id
     * @return SummeryModel|null
     */
    public function findModelByUserId(int $user_id) :?SummeryModel {
        if(($model = $this->model->find()->where(['user_id' => $user_id])->one()) !== null) {
            return  $model;
        } else {
            return  $this->model;
        }

    }
}