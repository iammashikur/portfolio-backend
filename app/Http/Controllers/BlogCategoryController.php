<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogCategoryStoreRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BlogCategory::class);

        $search = $request->get('search', '');

        $blogCategories = BlogCategory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.blog_categories.index',
            compact('blogCategories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BlogCategory::class);

        return view('app.blog_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', BlogCategory::class);

        $validated = $request->validated();

        $blogCategory = BlogCategory::create($validated);

        return redirect()
            ->route('blog-categories.edit', $blogCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BlogCategory $blogCategory): View
    {
        $this->authorize('view', $blogCategory);

        return view('app.blog_categories.show', compact('blogCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BlogCategory $blogCategory): View
    {
        $this->authorize('update', $blogCategory);

        return view('app.blog_categories.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BlogCategoryUpdateRequest $request,
        BlogCategory $blogCategory
    ): RedirectResponse {
        $this->authorize('update', $blogCategory);

        $validated = $request->validated();

        $blogCategory->update($validated);

        return redirect()
            ->route('blog-categories.edit', $blogCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BlogCategory $blogCategory
    ): RedirectResponse {
        $this->authorize('delete', $blogCategory);

        $blogCategory->delete();

        return redirect()
            ->route('blog-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
