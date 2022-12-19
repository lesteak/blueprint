<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Yadda\Enso\Facades\EnsoCrud;

/**
 * Composer for adding all locations to the given View
 */
class LocationsComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with(
            'locations',
            EnsoCrud::query('location')->orderBy('name', 'asc')->get(),
        );
    }
}
