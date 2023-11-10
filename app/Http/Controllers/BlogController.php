<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogUpdateRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Blog::class);

        $search = $request->get('search', '');

        $blogs = Blog::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.blogs.index', compact('blogs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Blog::class);

        $blogCategories = BlogCategory::pluck('name', 'id');

        return view('app.blogs.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Blog::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $blog = Blog::create($validated);

        return redirect()
            ->route('blogs.edit', $blog)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Blog $blog): View
    {
        $this->authorize('view', $blog);

        return view('app.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Blog $blog): View
    {
        $this->authorize('update', $blog);

        $blogCategories = BlogCategory::pluck('name', 'id');

        return view('app.blogs.edit', compact('blog', 'blogCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BlogUpdateRequest $request,
        Blog $blog
    ): RedirectResponse {
        $this->authorize('update', $blog);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::delete($blog->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $blog->update($validated);

        return redirect()
            ->route('blogs.edit', $blog)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Blog $blog): RedirectResponse
    {
        $this->authorize('delete', $blog);

        if ($blog->image) {
            Storage::delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
