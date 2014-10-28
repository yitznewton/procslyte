<?php

namespace Yitznewton\Procslyte\Render;

class AffixRenderer extends DecoratingRenderer implements Renderer
{
    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return $this->prefix() . $this->innerRenderer->render($citationData) . $this->suffix();
    }

    private function prefix()
    {
        return $this->settingOrBlank('prefix');
    }

    private function suffix()
    {
        return $this->settingOrBlank('suffix');
    }

    private function settingOrBlank($settingName)
    {
        return \igorw\get_in($this->settings, [$settingName], '');
    }
}
