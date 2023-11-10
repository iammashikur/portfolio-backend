<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ExperienceStoreRequest;
use App\Http\Requests\ExperienceUpdateRequest;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Experience::class);

        $search = $request->get('search', '');

        $experiences = Experience::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.experiences.index', compact('experiences', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Experience::class);

        return view('app.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Experience::class);

        $validated = $request->validated();

        $experience = Experience::create($validated);

        return redirect()
            ->route('experiences.edit', $experience)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Experience $experience): View
    {
        $this->authorize('view', $experience);

        return view('app.experiences.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Experience $experience): View
    {
        $this->authorize('update', $experience);

        return view('app.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ExperienceUpdateRequest $request,
        Experience $experience
    ): RedirectResponse {
        $this->authorize('update', $experience);

        $validated = $request->validated();

        $experience->update($validated);

        return redirect()
            ->route('experiences.edit', $experience)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Experience $experience
    ): RedirectResponse {
        $this->authorize('delete', $experience);

        $experience->delete();

        return redirect()
            ->route('experiences.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
