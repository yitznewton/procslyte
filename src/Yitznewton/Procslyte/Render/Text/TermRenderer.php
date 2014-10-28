<?php

namespace Yitznewton\Procslyte\Render\Text;

use Yitznewton\Procslyte\Render\Renderer;
use Yitznewton\Procslyte\UndefinedIndexException;

class TermRenderer implements Renderer
{
    private $termName;
    private $options;
    private $termSettings;

    /**
     * @param array $termName
     * @param array $termSet
     * @param array $options
     */
    public function __construct($termName, array $termSet, array $options = [])
    {
        $this->termSettings = $this->in($termSet, [$termName]);

        if (!$this->termSettings) {
            throw new UndefinedIndexException();
        }

        $this->termName = $termName;
        $this->options = $options;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        foreach ($this->termSettings as $setting) {
            if ($this->matchesCriteria($setting)) {
                return $this->renderSetting($setting);
            }
        }

        return $this->renderDefault();
    }

    /**
     * @param array $setting
     * @return bool
     */
    private function matchesCriteria($setting)
    {
        if (!isset($this->options['form'])) {
            return $this->in($setting, ['form']) == 'long';
        }

        return $this->in($setting, ['form']) == $this->options['form'];
    }

    private function renderDefault()
    {
        foreach ($this->termSettings as $setting) {
            if ($this->in($setting, ['form']) == 'long') {
                return $this->renderSetting($setting);
            }
        }

        return null;
    }

    private function renderSetting($setting)
    {
        $returnMultiple = $this->in($this->options, ['plural']);
        $valueMultiple = $this->in($setting, ['valueMultiple']);

        if ($returnMultiple && $valueMultiple) {
            return $valueMultiple;
        } else {
            return $this->in($setting, ['value']);
        }
    }

    /**
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    private function in(array $array, array $keys)
    {
        return \igorw\get_in($array, $keys);
    }
}
