<?php

namespace common\modules\summery\modules\cabinet\forms;

use common\modules\summery\modules\cabinet\enum\SummeryStatusEnum;
use yii\base\Model;

/**
 * Class SummeryForm
 * @package common\modules\summery\modules\cabinet\forms
 */
class SummeryForm extends Model
{
    public $filename;
    public $status = SummeryStatusEnum::STATUS_LOAD;

    /**
     * @return array
     */
    public function rules()
    {
        return[
            ['filename', 'user_id'] , 'required',
            ['filename', 'string' => 15]
        ];
    }
}