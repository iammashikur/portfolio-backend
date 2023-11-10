<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogCommentStoreRequest;
use App\Http\Requests\BlogCommentUpdateRequest;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BlogComment::class);

        $search = $request->get('search', '');

        $blogComments = BlogComment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.blog_comments.index',
            compact('blogComments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BlogComment::class);

        $blogs = Blog::pluck('title', 'id');

        return view('app.blog_comments.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCommentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', BlogComment::class);

        $validated = $request->validated();

        $blogComment = BlogComment::create($validated);

        return redirect()
            ->route('blog-comments.edit', $blogComment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BlogComment $blogComment): View
    {
        $this->authorize('view', $blogComment);

        return view('app.blog_comments.show', compact('blogComment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BlogComment $blogComment): View
    {
        $this->authorize('update', $blogComment);

        $blogs = Blog::pluck('title', 'id');

        return view('app.blog_comments.edit', compact('blogComment', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BlogCommentUpdateRequest $request,
        BlogComment $blogComment
    ): RedirectResponse {
        $this->authorize('update', $blogComment);

        $validated = $request->validated();

        $blogComment->update($validated);

        return redirect()
            ->route('blog-comments.edit', $blogComment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BlogComment $blogComment
    ): RedirectResponse {
        $this->authorize('delete', $blogComment);

        $blogComment->delete();

        return redirect()
            ->route('blog-comments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
