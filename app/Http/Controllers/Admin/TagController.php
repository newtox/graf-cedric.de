<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view tags')->only('index');
        $this->middleware('permission:create tags')->only(['create', 'store']);
        $this->middleware('permission:edit tags')->only(['edit', 'update']);
        $this->middleware('permission:delete tags')->only('destroy');
    }

    public function index(): View
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request): RedirectResponse
    {
        Tag::create($request->validated());
        return redirect()->route('admin.tags.index')
            ->with('success', __('tags.messages.created'));
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());
        return redirect()->route('admin.tags.index')
            ->with('success', __('tags.messages.updated'));
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')
            ->with('success', __('tags.messages.deleted'));
    }
}
