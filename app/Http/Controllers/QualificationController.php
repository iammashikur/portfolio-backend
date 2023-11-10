<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\QualificationStoreRequest;
use App\Http\Requests\QualificationUpdateRequest;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Qualification::class);

        $search = $request->get('search', '');

        $qualifications = Qualification::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.qualifications.index',
            compact('qualifications', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Qualification::class);

        return view('app.qualifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QualificationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Qualification::class);

        $validated = $request->validated();

        $qualification = Qualification::create($validated);

        return redirect()
            ->route('qualifications.edit', $qualification)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Qualification $qualification): View
    {
        $this->authorize('view', $qualification);

        return view('app.qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Qualification $qualification): View
    {
        $this->authorize('update', $qualification);

        return view('app.qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        QualificationUpdateRequest $request,
        Qualification $qualification
    ): RedirectResponse {
        $this->authorize('update', $qualification);

        $validated = $request->validated();

        $qualification->update($validated);

        return redirect()
            ->route('qualifications.edit', $qualification)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Qualification $qualification
    ): RedirectResponse {
        $this->authorize('delete', $qualification);

        $qualification->delete();

        return redirect()
            ->route('qualifications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
