<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\frontend_new\assets\widgets\ImportAsset::register($this);

?>
<div class="col-xs-12 col-sm-9">
    <div class="summery-body">
        <div class="row-block">
            <div class="col-xs-12">
                <label class="text-8f8">
                    <span><?= Yii::t('frontend', 'Вы можете заполнить Ваше резюме и сохраниьт его на сайте. Это позволить значительно быстрее и эффективнее откликаться на вакансии. Вы можете изменить резюме в любой момент.')?></span>
                </label>
            </div>
        </div>
        <div class="row-block">
            <div class="col-xs-12">
                <div class="pay-import">
                    <?= Html::button(Yii::t('frontend', 'Загрузить резюме'),
                        ['class' => 'btn btn-primary'])?>
                </div>
            </div>
        </div>
    </div>
</div>


