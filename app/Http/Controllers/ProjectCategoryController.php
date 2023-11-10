<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProjectCategoryStoreRequest;
use App\Http\Requests\ProjectCategoryUpdateRequest;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ProjectCategory::class);

        $search = $request->get('search', '');

        $projectCategories = ProjectCategory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.project_categories.index',
            compact('projectCategories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ProjectCategory::class);

        return view('app.project_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ProjectCategoryStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ProjectCategory::class);

        $validated = $request->validated();

        $projectCategory = ProjectCategory::create($validated);

        return redirect()
            ->route('project-categories.edit', $projectCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ProjectCategory $projectCategory
    ): View {
        $this->authorize('view', $projectCategory);

        return view('app.project_categories.show', compact('projectCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ProjectCategory $projectCategory
    ): View {
        $this->authorize('update', $projectCategory);

        return view('app.project_categories.edit', compact('projectCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProjectCategoryUpdateRequest $request,
        ProjectCategory $projectCategory
    ): RedirectResponse {
        $this->authorize('update', $projectCategory);

        $validated = $request->validated();

        $projectCategory->update($validated);

        return redirect()
            ->route('project-categories.edit', $projectCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ProjectCategory $projectCategory
    ): RedirectResponse {
        $this->authorize('delete', $projectCategory);

        $projectCategory->delete();

        return redirect()
            ->route('project-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
