<?php


namespace common\modules\summery\classes;


use common\modules\summery\modules\cabinet\enum\SummeryStatusEnum;
use Yii;
use yii\web\HttpException;

/**
 * Class SummeryIsWorkForApi
 * @package common\modules\summery\classes
 */
class SummeryIsWorkForApi extends SummeryIsWorkClasses
{


    /**
     * @var \yii\web\IdentityInterface|null
     */
    protected $user;

    public function __construct(array $message)
    {
        parent::__construct($message);

        $this->user = Yii::$app->user->identity;

        if(!$this->is_work) {
            throw new HttpException(200, 'Category is not work');
        }

        if($this->is_my) {
            throw new HttpException(200, 'Messages is my, we don`t send this message');
        }
    }

    public function getResult(): array
    {
        $result = [];
        if(!empty($this->user->summery) && $this->user->summery->status == SummeryStatusEnum::STATUS_LOAD) {
            $result = $this->result();
        }
        return  (array)$result;
    }

}