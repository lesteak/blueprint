<?php

namespace App\View;

class Nav
{
    /**
     * Check a given URL against the current request and
     * return true if the two match. Matches will be fuzzy and will prepend
     * the domain if required.
     */
    public function isCurrent($url): bool
    {
        $current = request()->url();

        if ($url === $current) {
            return true;
        }

        if (url($url) === $current) {
            return true;
        }

        return false;
    }
}
