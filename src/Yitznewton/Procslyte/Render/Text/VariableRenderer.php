<?php

namespace Yitznewton\Procslyte\Render\Text;

use Yitznewton\Procslyte\Render\Group\VariableUsagePublisher;
use Yitznewton\Procslyte\Render\Group\VariableUsageSubscriber;
use Yitznewton\Procslyte\Render\Renderer;

class VariableRenderer implements Renderer, VariableUsagePublisher
{
    /**
     * @var VariableUsageSubscriber[]
     */
    private $subscribers = [];
    private $variable;
    private $form;

    /**
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->variable = \igorw\get_in($settings, ['variable']);
        $this->form = \igorw\get_in($settings, ['form']);
    }

    /**
     * @param VariableUsageSubscriber $subscriber
     */
    public function addVariableSubscriber(VariableUsageSubscriber $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $variableNameWithForm = sprintf('%s-%s', $this->variable, $this->form);

        if ($this->form && isset($citationData[$variableNameWithForm])) {
            return $citationData[$variableNameWithForm];
        }

        $render = \igorw\get_in($citationData, [$this->variable], '');
        $this->publishUsage($render);

        return $render;
    }

    private function publishUsage($render)
    {
        foreach ($this->subscribers as $subscriber) {
            if ($render) {
                $subscriber->registerNonemptyVariable();
            } else {
                $subscriber->registerEmptyVariable();
            }
        }
    }
}
