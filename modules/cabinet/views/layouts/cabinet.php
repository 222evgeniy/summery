<?php


/**
 * @var $this \yii\web\View
 */
\common\modules\summery\modules\cabinet\assets\SummeryAssets::register($this);

$this->params['hide_search'] = true;
$this->beginContent('@app/views/layouts/cabinet.php');
?>
<div id="safe-deal-cabinet-layout" class="tab-pane fade in active">
    <div class="tab-body mb-10  summery-tab">
        <div class="tab-content">
            <?= $content; ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>

