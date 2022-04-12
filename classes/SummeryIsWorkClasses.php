<?php

namespace common\modules\summery\classes;

use backend\modules\category\models\Category;
use common\classes\PhoneHelper;
use common\modules\summery\modules\cabinet\behaviors\SummeryBehavior;
use common\modules\summery\modules\cabinet\enum\SummeryStatusEnum;
use Yii;
use yii\base\BaseObject;
use yii\web\HttpException;

/**
 * Class SummeryIsWorkClasses
 * @package common\modules\summery\classes
 */
class SummeryIsWorkClasses
{

    /** @var array  */
    protected $message;

    /** @var boolean */
    protected $is_work;

    /** @var boolean */
    protected $is_my;

    /** @var int */
    public $category_id;
    /** @var int */
    public $user_id;

    public function __construct(array $message)
    {
        $this->category_id = $message['category_id'];
        $this->user_id = $message['user_id'];

        $this->user = Yii::$app->user->identity;
        $this->user->attachBehavior('summery', SummeryBehavior::class);
        $this->init();
    }

    public function init()
    {
        $this->is_work = Category::isCategoryWork($this->category_id);
        $this->isMy();
    }

    public function getResult(): array {

        $result = [];

        if($this->is_work && !$this->is_my && (!empty($this->user->summery) && $this->user->summery->status == SummeryStatusEnum::STATUS_LOAD)) {
            $result = $this->result();
        }

        return  (array)$result;
    }

    protected function result() {

        return new ResultSummery([
            'is_work' => true,
            'text_with' => Yii::t('summery', "Здравствуйте, в ответ на вашу вакансию, отправляю свое резюме. С нетерпением буду ожидать ваше решение. Мой номер телефона {0}. Спасибо.",[PhoneHelper::prepareNumberFormat($this->user->username)]),
            'text_not_with' => Yii::t('summery', "Здравствуйте, меня заинтересовала ваша вакансия, пожалуйста, предоставьте более подробную информацию, позвонив на мой номер {0}. Спасибо.",[PhoneHelper::prepareNumberFormat($this->user->username)]),
            'summery_id' => $this->user->summery->id,
            'link' => current((new SummeryGetLink([
                'summery' => $this->user->summery,
                'user' => $this->user,
            ]))->getLinks()),
            'filename' => $this->user->summery->filename
        ]);
    }

    protected function isMy() {
        $this->is_my = $this->user_id == $this->user->id;
    }
}