<?php
/**
 * @var $this \yii\web\View
 */
\common\modules\summery\modules\cabinet\assets\SummeryAssets::register($this);

$this->params['hide_search'] = true;
$this->beginContent('@app/views/layouts/main.php');
?>
<div class="container" id="cabinet">
    <div class="row row-md mb-10" id="cabinet-block-content">
        <div class="col-xs-12" style="background-color: #fff; height: 100%">
            <?= 123;?>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>

