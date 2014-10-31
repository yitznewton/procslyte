<?php

namespace Yitznewton\Tests\Procslyte\Render\Substitution;

use Yitznewton\Procslyte\Render\Substitution\SubstitutionEvent;
use Yitznewton\Procslyte\Render\Substitution\SubstitutionListener;

class SpySubstitutionListener implements SubstitutionListener
{
    private $event;

    /**
     * @param SubstitutionEvent $event
     */
    public function substitute(SubstitutionEvent $event)
    {
        $this->event = $event;
    }

    /**
     * @return bool
     */
    public function receivedEvent()
    {
        return !empty($this->event);
    }

    /**
     * @return SubstitutionEvent
     */
    public function getEvent()
    {
        return $this->event;
    }
}
