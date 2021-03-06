<?php
/**
 * User: Vladimir Baranov <phpnt@yandex.ru>
 * Git: <https://github.com/phpnt>
 * VK: <https://vk.com/phpnt>
 * Date: 02.02.2019
 * Time: 9:56
 */

namespace common\widgets\TemplateOfElement\fields;

use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\InputWidget;
use yii\helpers\ArrayHelper;

class FieldTextRangeTo extends InputWidget
{
    public $modelFieldForm;
    public $options = [];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        /* @var $fieldsManage \common\widgets\TemplateOfElement\components\FieldsManage */
        $fieldsManage = Yii::$app->fieldsManage;

        $formName = $this->model->formName();
        $fieldID = $this->modelFieldForm->id;

        $value = isset($this->model->elements_fields[$this->modelFieldForm->id][1]) ? $this->model->elements_fields[$this->modelFieldForm->id][1] : $fieldsManage->getValue($this->modelFieldForm->id, $this->modelFieldForm->type, $this->model->id);

        if (is_array($value)) {
            $value = $value[1];
        }

        $options = [
            'id' => 'field-' . $fieldID . '-1',
            'name' => $formName . "[elements_fields][$fieldID][1]",
            'value' => $value,
        ];

        $this->options = ArrayHelper::merge($this->options, $options);

        $this->field->label(Yii::t('app', $this->modelFieldForm->name));

        if (isset($this->model->errors_fields[$this->modelFieldForm->id][1])) {
            $error = $this->model->errors_fields[$this->modelFieldForm->id][1];
            $view = $this->getView();
            $view->registerJs('addError("#group-' .  $this->modelFieldForm->id . '-1", "' . $error . '");');
        }

        echo Html::activeTextInput($this->model, $this->attribute, $this->options);
    }
}