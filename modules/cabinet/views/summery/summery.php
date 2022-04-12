<?php
/**
 * @var \common\modules\summery\modules\cabinet\models\SummeryModel $summery
 */
?>
<div class="fl-100 par-file-upl mb-10" id="summery_file" >
    <span><?= Yii::t('summery', 'Вы можете прикрепить к сообщению Ваше резюме') ?></span>
    <div class="a-ad3 upl-text mt-10" >
        <div class="checkbox checkbox-point" style="float: left; margin-top: 0; margin-right: 30px">
            <a role="button">
                <label class="label_for_cb">
                    <input type="checkbox" id="summery" class="input-style-summery" name="scales">
                    <span class="check-stack check-1">
                    <i class="check-2"></i>
                    <svg width="10" height="8" class="check-3">
                        <use xlink:href="/img/picons-v1.svg#done"></use>
                    </svg>
                </span>
                </label>
            </a>
        </div>
        <svg width="16" height="20" class="fill-primary">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/img/cicons.svg#attachment"></use>
        </svg>
        <span class="label-text-upl"><?=\yii\helpers\Html::a($summery->filename, '#') ?></span>
    </div>
</div>