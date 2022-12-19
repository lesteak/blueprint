<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Yadda\Enso\Crud\Traits\UsesPage;
use Yadda\Enso\Facades\EnsoMeta;

class TrainerController extends Controller
{
    use UsesPage;

    /**
     * Show an individual trainer.
     *
     * @param Trainer $trainer
     *
     * @return \Illuminate\View\View
     */
    public function show(Trainer $trainer): \Illuminate\View\View
    {
        if (!Gate::allows('view', $trainer)) {
            abort(404);
        }

        $page = $this->usePageAllowUnpublished('trainer');

        $meta = $trainer->getMeta();

        $meta->overrideTitle($trainer->name);
        $meta->overrideImage($trainer->thumbnail ?? $trainer->heroImage);

        EnsoMeta::use($meta);

        return View::make('trainers.show', compact('page', 'trainer'));
    }
}
