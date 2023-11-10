<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ToolStoreRequest;
use App\Http\Requests\ToolUpdateRequest;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Tool::class);

        $search = $request->get('search', '');

        $tools = Tool::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tools.index', compact('tools', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Tool::class);

        return view('app.tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ToolStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Tool::class);

        $validated = $request->validated();

        $tool = Tool::create($validated);

        return redirect()
            ->route('tools.edit', $tool)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Tool $tool): View
    {
        $this->authorize('view', $tool);

        return view('app.tools.show', compact('tool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tool $tool): View
    {
        $this->authorize('update', $tool);

        return view('app.tools.edit', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ToolUpdateRequest $request,
        Tool $tool
    ): RedirectResponse {
        $this->authorize('update', $tool);

        $validated = $request->validated();

        $tool->update($validated);

        return redirect()
            ->route('tools.edit', $tool)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tool $tool): RedirectResponse
    {
        $this->authorize('delete', $tool);

        $tool->delete();

        return redirect()
            ->route('tools.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
