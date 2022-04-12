<?php

/**
 * @var \common\modules\summery\modules\cabinet\models\SummeryModel $summery
 * @var \common\models\User $user
 */

use common\modules\summery\modules\cabinet\enum\SummeryStatusEnum;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="col-xs-12 col-sm-9">
    <div class="summery-body">
        <div class="row-block">
            <div class="col-xs-12">
                <label class="text-header">
                    <span><?= Yii::t('summery', 'Вы можете заполнить Ваше резюме и сохранить его на сайте. Это позволит значительно быстрее и эффективнее откликаться на вакансии. Вы можете изменить резюме в любой момент.')?></span>
                    <br/>
                    <span><?= Yii::t('summery', 'Загруженное вами резюме вы сможете быстро прикреплять к сообщениям в интересующих вас вакансиях.')?></span>
</label>
            </div>
        </div>
        <div class="row-block" style="margin-left: 10px; height: 55px; margin-top: -20px">
            <?php $form = ActiveForm::begin([
                'options' => [
                        'enctype' => 'multipart/form-data',
                ],
                'id' => 'summery_form',

            ])?>
            <?php echo $form->field($summery, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>
                <div class="file-upload">
                    <div class="fl-file par-file-upl">
                        <?php $text = $summery->filename && $summery->status == SummeryStatusEnum::STATUS_LOAD ? $summery->filename : Yii::t('frontend', 'Прикрепить файл'); ?>
                        <div class="a-ad3 upl-text">
                            <svg width="16" height="20" class="fill-primary">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/img/cicons.svg#attachment"></use>
                            </svg>
                            <span class="label-text-upl"><?= $text ?></span>
                        </div>
                        <?= $form->field($summery, 'filename', ['options' => ['tag'=> null], 'template' => '{input}'])->fileInput([
                            'accept' => 'application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.oasis.opendocument.text',
                            'id' => 'summery_file',
                            'placeholder' => $text
                        ])->label(false)?>

                    </div>
                    <?php $display = $summery->filename && $summery->status == SummeryStatusEnum::STATUS_LOAD?>
                </div>
            <?php ActiveForm::end(); ?>
            <?=  Html::a(Yii::t('summery', 'Удалить'), '#', [
                'class' => 'link_delete',
                'id'=>'link_delete',
                'style' => ["display" => $display ? 'block' : 'none'],
                'data-id' => $summery->id,
                'data-token' => $user->tokenapi

            ])?>
        </div>

        <div class="row-block">
            <div class="col-xs-12">
                <label class="text-8f8">
                    <span><?= Yii::t('summery', 'Заполняя резюме, вы соглашаетесь, что сайт Бесплатка может создать ваш индивидуальный профиль кандидата на основе данных, включенных в ваше резюме.')?></span>
                </label>
            </div>
        </div>
    </div>
</div>
