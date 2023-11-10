<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Skill::class);

        $search = $request->get('search', '');

        $skills = Skill::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.skills.index', compact('skills', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Skill::class);

        return view('app.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Skill::class);

        $validated = $request->validated();

        $skill = Skill::create($validated);

        return redirect()
            ->route('skills.edit', $skill)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Skill $skill): View
    {
        $this->authorize('view', $skill);

        return view('app.skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Skill $skill): View
    {
        $this->authorize('update', $skill);

        return view('app.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SkillUpdateRequest $request,
        Skill $skill
    ): RedirectResponse {
        $this->authorize('update', $skill);

        $validated = $request->validated();

        $skill->update($validated);

        return redirect()
            ->route('skills.edit', $skill)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Skill $skill): RedirectResponse
    {
        $this->authorize('delete', $skill);

        $skill->delete();

        return redirect()
            ->route('skills.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
