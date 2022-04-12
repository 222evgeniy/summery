<?php
namespace common\modules\summery;

use api\components\ApiApplication;
use common\config\CommonConfigInterface;
use common\modules\summery\modules\cabinet\events\CommetSummeryEvent;
use common\modules\summery\modules\cabinet\iterfaces\CommentSummeryIntraface;
use common\modules\summery\modules\cabinet\models\SummeryCommentModel;
use common\modules\summery\modules\cabinet\models\SummeryModel;
use common\modules\summery\modules\cabinet\SummerCabinetModule;
use common\modules\summery\modules\rest\SummeryApiModule;
use common\traits\RegisterModuleUrlRulesTrait;
use common\traits\RegisterTranslateTrait;
use console\components\ConsoleApplication;
use frontend\models\CommentsNew;
use frontend_new\components\FrontendApplication;
use frontend_new\widgets\cabinet\CabinetMenuWidget;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\Module;
use yii\base\Widget;
use yii\web\GroupUrlRule;

/**
 * Class SummeryModule
 * @package common\modules\summery
 * @include @root/modules/summery/summery-component.md
 *
 * @author evgeniy antonov
 */
class SummeryModule extends Module implements BootstrapInterface
{
    const LOAD_MODULE_SUMMERY = 'load module summery';

    use RegisterTranslateTrait;
    use RegisterModuleUrlRulesTrait;

    /**
     * @param Application $app
     * @return mixed
     */
    public function bootstrap($app)
    {
        $this->registerTranslations('summery', false);

        $this->addEvent();

        if ($app instanceof ConsoleApplication){
            $app->controllerMap['migrate']['migrationPath'][] = '@common/modules/summery/migrations';
            $this->controllerNamespace = 'common\modules\summery\commands';
        } elseif ($app instanceof FrontendApplication){
            $this->controllerNamespace = 'common\modules\summery\frontend\controllers';
            $this->viewPath = __DIR__ .'/frontend/views';
            $this->layout = 'summery';

            $this->addUrlRules($app);
            $this->addEventListener();
        } elseif ($app instanceof ApiApplication) {
            $this->registerModuleUrlRules($app);

        }
    }

    /**
     * @inheritDoc
     */
    public function init()
    {
        $modules = [];

        if (Yii::$app instanceof FrontendApplication) {
            $modules = [
                'cabinet' => ['class' => SummerCabinetModule::class],
            ];
        } else if (Yii::$app instanceof ApiApplication) {
            $modules = [
                'rest' => ['class' => SummeryApiModule::class],
            ];
        }

        $this->setModules($modules);

        parent::init();
    }

    /**
     * @param FrontendApplication $app
     */
    protected function addUrlRules(FrontendApplication $app){
        $app->urlManager->addRules([
            [
                'class' => GroupUrlRule::class,
                'prefix' => 'summery',
                'routePrefix' => $this->getUniqueId(),
                'rules' => [
                    'api/<action:.+>' => 'api/<action>',
                    '<controller:.+>/<action:.+>' => '<controller>/<action>',
                    '<action:.+>' => 'summery/<action>',
                ],

            ],
            'cabinet/summery' => $this->getUniqueId() . '/cabinet',
            'cabinet/summery/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->getUniqueId() . '/cabinet/<controller>/<action>',
        ], false);

    }

    /**
     * @inheritDoc
     */
    protected function addEvent() {
        Event::on(CommentsNew::class, CommentSummeryIntraface::SAVE_COMMENT_SUMMERY, function (CommetSummeryEvent $event){
            try {
                $summery_id = $event->summery_id;
                $sender = $event->sender;
                $summery = SummeryModel::find()->where(['id' => $summery_id])->one();
                $id = $sender->id;
                $summerycomment = new SummeryCommentModel();
                $summerycomment->comment_id = $id;
                $summerycomment->summery_id = $summery_id;
                $summerycomment->url = $summery->url;
                $summerycomment->filename = $summery->filename;
                $summerycomment->save();
            } catch (\Exception $e) {
                /** @var CommonConfigInterface $app */
                $app = Yii::$app;
                $app->sendMail->sendEmail(Yii::$app->params['admin'], 'save comment summery', $e->getMessage());
            }
        });
    }

    /**
     * @inheritDoc
     */
    protected function addEventListener() {
        Event::on(CabinetMenuWidget::class, Widget::EVENT_INIT, function (Event $event) {
            /** @var CabinetMenuWidget $widget */
            $widget = $event->sender;
            $widget->addTab('summery', [
                'target' => 'tab-safe-deal',
                'key' => 'summery',
                'title' => Yii::t('summery', 'Резюме'),
                'text' => Yii::t('summery', 'Резюме'),
                'svg' => 'summery',
                'active' => false,
            ]);
        });


    }


}