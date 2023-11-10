<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SocialLinkStoreRequest;
use App\Http\Requests\SocialLinkUpdateRequest;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SocialLink::class);

        $search = $request->get('search', '');

        $socialLinks = SocialLink::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.social_links.index', compact('socialLinks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SocialLink::class);

        return view('app.social_links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialLinkStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SocialLink::class);

        $validated = $request->validated();

        $socialLink = SocialLink::create($validated);

        return redirect()
            ->route('social-links.edit', $socialLink)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SocialLink $socialLink): View
    {
        $this->authorize('view', $socialLink);

        return view('app.social_links.show', compact('socialLink'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SocialLink $socialLink): View
    {
        $this->authorize('update', $socialLink);

        return view('app.social_links.edit', compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SocialLinkUpdateRequest $request,
        SocialLink $socialLink
    ): RedirectResponse {
        $this->authorize('update', $socialLink);

        $validated = $request->validated();

        $socialLink->update($validated);

        return redirect()
            ->route('social-links.edit', $socialLink)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SocialLink $socialLink
    ): RedirectResponse {
        $this->authorize('delete', $socialLink);

        $socialLink->delete();

        return redirect()
            ->route('social-links.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
