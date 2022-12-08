<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;
use Yadda\Enso\Crud\Traits\UsesPage;
use Yadda\Enso\Facades\EnsoCrud;

class PageController extends Controller
{
    use UsesPage;

    /**
     * Custom redirects for pages
     *
     * @param string $slug
     *
     * @return RedirectResponse|null
     */
    protected function checkForRedirects(string $slug): ?RedirectResponse
    {
        switch ($slug) {
            case 'timetables':
                $location = EnsoCrud::query('location')
                    ->orderBy('name', 'asc')
                    ->first();

                if ($location) {
                    return Redirect::route(
                        'locations.timetable',
                        ['location' => $location->slug]
                    );
                }

                return null;
            default:
                return null;
        }
    }

    /**
     * Show the page it's slug
     *
     * @param string $slug
     *
     * @return View|RedirectResponse
     */
    public function show($slug)
    {
        if ($redirect = $this->checkForRedirects($slug)) {
            return $redirect;
        }

        $page = $this->usePage($slug);

        return ViewFacade::make($page->getViewName(), compact('page'));
    }
}
