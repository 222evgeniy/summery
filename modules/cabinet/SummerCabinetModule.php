<?php


namespace common\modules\summery\modules\cabinet;
use frontend_new\widgets\cabinet\CabinetMenuWidget;
use yii\base\Event;
use yii\base\Module;
use yii\base\Widget;

/**
 * Class SummerCabinetModule
 * @package common\modules\summery\modules\cabinet
 * @property string $controllerNamespace
 * @property string $defaultRoute
 * @property string $layout
 */
class SummerCabinetModule extends Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'common\modules\summery\modules\cabinet\controllers';
    /**
     * @var string
     */
    public $defaultRoute = 'summery/index';
    /**
     * @var string
     */
    public $layout = 'cabinet';

    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        Event::on(CabinetMenuWidget::class, Widget::EVENT_INIT, function (Event $event) {
            /** @var CabinetMenuWidget $widget */
            $widget = $event->sender;
            $widget->activeTab = 'summery';
        });

        return parent::beforeAction($action);
    }

}