<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yadda\Enso\Facades\EnsoCrud;

class LocationController extends Controller
{
    const DEFAULT_PER_PAGE = 12;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if (Gate::denies('viewAny', EnsoCrud::modelClass('location'))) {
            abort(404);
        }

        $query = $this->getIndexQuery($request);

        $results = ($request->input('per_page') === 'all')
            ? $query->get()
            : $query->paginate(intval($request->input('per_page', static::DEFAULT_PER_PAGE)));

        return LocationListResource::collection($results)->toResponse($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }

    /**
     * Generate an index query based on the given request
     *
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getIndexQuery(Request $request): \Illuminate\Database\Eloquent\Builder
    {
        $query = EnsoCrud::query('location')
            ->with([
                'classes',
                'thumbnail',
                'trainers',
            ]);

        $query->when($request->filled('class'), function  ($query) use ($request) {
            $query->whereHas('classes', function ($query) use ($request) {
                $query->where('slug', $request->get('class'));
            });
        });

        $query->when($request->filled('trainer'), function  ($query) use ($request) {
            $query->whereHas('trainers', function ($query) use ($request) {
                $query->where('slug', $request->get('trainer'));
            });
        });

        return $query;
    }
}
