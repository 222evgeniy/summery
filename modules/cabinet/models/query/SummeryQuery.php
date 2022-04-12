<?php

namespace common\modules\summery\modules\cabinet\models\query;

use common\modules\summery\modules\cabinet\models\SummeryModel;
use yii\db\ActiveQuery;

/**
 * Class SummeryQuery
 * @package common\modules\summery\modules\cabinet\models\query
 */
class SummeryQuery extends ActiveQuery
{
    /**
     * @param int $id
     * @return SummeryModel|null
     */
    public function findOne(int $id) :?SummeryModel
    {
        return $this->andWhere(['id' => $id])->one();
    }
    /**
     * {@inheritdoc}
     * @return SummeryModel[]|array
     */
    public function all($db = null) :?SummeryModel
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SummeryModel|array|null
     */
    public function one($db = null) :?SummeryModel
    {
        return parent::one($db);
    }
}