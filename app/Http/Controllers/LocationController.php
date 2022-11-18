<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Yadda\Enso\Crud\Traits\UsesPage;
use Yadda\Enso\Facades\EnsoMeta;

class LocationController extends Controller
{
    use UsesPage;

    /**
     * Show an individual trainer.
     *
     * @param Location $location
     *
     * @return \Illuminate\View\View
     */
    public function show(Location $location): \Illuminate\View\View
    {
        if (!Gate::allows('view', $location)) {
            abort(404);
        }

        $page = $this->usePageAllowUnpublished('location');

        $meta = $location->getMeta();

        $meta->overrideTitle($location->name);
        $meta->overrideImage($location->thumbnail ?? $location->heroImage);

        EnsoMeta::use($meta);

        return View::make('locations.show', compact('page', 'location'));
    }

    /**
     * Show the timetable for a given page
     *
     * @param Location $location
     *
     * @return \Illuminate\View\View
     */
    public function timetable(Location $location): \Illuminate\View\View
    {
        if (!Gate::allows('view', $location)) {
            abort(404);
        }

        $page = $this->usePage('timetable');

        $meta = $location->getMeta();

        $meta->overrideTitle($location->name);
        $meta->overrideImage($location->thumbnail ?? $location->heroImage);

        EnsoMeta::use($meta);

        return View::make('locations.timetable', compact('page', 'location'));
    }
}
