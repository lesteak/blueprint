<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Yadda\Enso\Crud\Traits\UsesPage;
use Yadda\Enso\Facades\EnsoMeta;

class ClassController extends Controller
{
    use UsesPage;

    /**
     * Show an individual trainer.
     *
     * @param ClassModel $class
     *
     * @return \Illuminate\View\View
     */
    public function show(ClassModel $class): \Illuminate\View\View
    {
        if (!Gate::allows('view', $class)) {
            abort(404);
        }

        $page = $this->usePageAllowUnpublished('class');

        $meta = $class->getMeta();

        $meta->overrideTitle($class->name);
        $meta->overrideImage($class->thumbnail ?? $class->heroImage);

        EnsoMeta::use($meta);

        return View::make('classes.show', compact('page', 'class'));
    }
}
