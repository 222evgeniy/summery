<?php


namespace common\modules\summery\modules\cabinet\assets;


use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * Class SummeryAssets
 * @package common\modules\summery\modules\cabinet\assets
 */
class SummeryAssets extends AssetBundle
{
    /**
     * @var string[]
     */
    public $depends = [
        BootstrapAsset::class,
    ];
    /**
     * @var string[]
     */
    public $css = [
        'css/summery.css',
    ];
    /**
     * @var string[]
     */
    public $js = [
        'js/summery.js',
        'https://unpkg.com/axios/dist/axios.min.js'
    ];
    /**
     * @var string
     */
    public $sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'summery';
}