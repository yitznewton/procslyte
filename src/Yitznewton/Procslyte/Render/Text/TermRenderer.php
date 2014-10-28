<?php

namespace Yitznewton\Procslyte\Render\Text;

use Yitznewton\Procslyte\InvalidTermException;
use Yitznewton\Procslyte\Render\Renderer;
use Yitznewton\Procslyte\UndefinedIndexException;

class TermRenderer implements Renderer
{
    private $options;
    private $termDefinitions;

    /**
     * @param array $termName
     * @param array $allTermDefinitions
     * @param array $options
     */
    public function __construct($termName, array $allTermDefinitions, array $options = [])
    {
        $this->termDefinitions = $this->in($allTermDefinitions, [$termName]);

        if (!$this->termDefinitions) {
            throw new UndefinedIndexException();
        }

        $this->options = $options;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        foreach ($this->termDefinitions as $definition) {
            if ($this->matchesCriteria($definition)) {
                return $this->renderDefinition($definition);
            }
        }

        return $this->renderDefault();
    }

    /**
     * @param array $definition
     * @return bool
     */
    private function matchesCriteria($definition)
    {
        if (!isset($this->options['form'])) {
            return $this->in($definition, ['form']) == 'long';
        }

        return $this->in($definition, ['form']) == $this->options['form'];
    }

    private function renderDefault()
    {
        foreach ($this->termDefinitions as $definition) {
            if ($this->in($definition, ['form']) == 'long') {
                return $this->renderDefinition($definition);
            }
        }

        throw new InvalidTermException();
    }

    private function renderDefinition($definition)
    {
        $returnMultiple = $this->in($this->options, ['plural']);
        $valueMultiple = $this->in($definition, ['valueMultiple']);
        $value = $this->in($definition, ['value']);

        if ($returnMultiple && $valueMultiple) {
            return $valueMultiple;
        } elseif (!$value) {
            throw new InvalidTermException();
        } else {
            return $value;
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
