<?php

namespace Yitznewton\Procslyte\Render\Substitution;

interface SubstitutionListener
{
    /**
     * @param SubstitutionEvent $event
     */
    public function substitute(SubstitutionEvent $event);
}
