<?php

namespace Yitznewton\Procslyte\Render\Substitution;

use Yitznewton\Procslyte\Render\Renderer;

class SubstitutableRenderer implements Renderer
{
    private $listener;
    private $defaultRenderer;
    private $substitutingRenderers = [];

    /**
     * @param Renderer $defaultRenderer
     * @param SubstitutionListener $listener
     */
    public function __construct(Renderer $defaultRenderer, SubstitutionListener $listener)
    {
        $this->defaultRenderer = $defaultRenderer;
        $this->listener = $listener;
    }

    /**
     * @param string $name
     * @param Renderer $renderer
     */
    public function addSubstitute($name, Renderer $renderer)
    {
        $this->substitutingRenderers[$name] = $renderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $defaultValue = $this->defaultRenderer->render($citationData);
        return $defaultValue ?: $this->findSubstituteValue($citationData);
    }

    private function findSubstituteValue(array $citationData)
    {
        foreach ($this->substitutingRenderers as $name => $renderer) {
            $substituteValue = $renderer->render($citationData);

            if ($substituteValue) {
                $this->listener->substitute(new SubstitutionEvent($name));
                return $substituteValue;
            }
        }

        return '';
    }
}
