<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Company;
use App\Models\Game;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create games')->only(['create', 'store']);
        $this->middleware('permission:edit games')->only(['edit', 'update']);
        $this->middleware('permission:delete games')->only('destroy');
    }

    public function index(Request $request): View
    {
        $query = Game::with(['tags', 'developer', 'publisher']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhereHas('developer', fn($q2) => $q2->where('name', 'like', '%' . $request->search . '%'));
            });
        }

        if ($request->has('tags')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tags.id', (array) $request->tags);
            });
        }

        $games = $query->paginate(10);
        $tags = Tag::all();

        return view('admin.games.index', compact('games', 'tags'));
    }

    public function create(): View
    {
        $tags = Tag::all();
        $companies = Company::orderBy('name')->get();

        return view('admin.games.create', compact('tags', 'companies'));
    }

    public function store(GameRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $game = Game::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'developer_company_id' => $this->resolveCompanyId($request, 'developer'),
            'publisher_company_id' => $this->resolveCompanyId($request, 'publisher'),
        ]);

        if ($request->hasFile('thumbnail')) {
            $game->thumbnail = $request->file('thumbnail')->store('games', 'public');
            $game->save();
        }

        if ($request->has('tags')) {
            $game->tags()->sync($request->tags);
        }

        return redirect()->route('admin.games.index')
            ->with('success', __('games.messages.created'));
    }

    public function edit(Game $game): View
    {
        $tags = Tag::all();
        $companies = Company::orderBy('name')->get();

        return view('admin.games.edit', compact('game', 'tags', 'companies'));
    }

    public function update(GameRequest $request, Game $game): RedirectResponse
    {
        $validated = $request->validated();

        $game->title = $validated['title'];
        $game->developer_company_id = $this->resolveCompanyId($request, 'developer');
        $game->publisher_company_id = $this->resolveCompanyId($request, 'publisher');

        if ($request->hasFile('thumbnail')) {
            $game->thumbnail = $request->file('thumbnail')->store('games', 'public');
        }

        $game->save();

        if ($request->has('tags')) {
            $game->tags()->sync($request->tags);
        }

        return redirect()->route('admin.games.index')
            ->with('success', __('games.messages.updated'));
    }

    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        return redirect()->route('admin.games.index')
            ->with('success', __('games.messages.deleted'));
    }

    private function resolveCompanyId(Request $request, string $prefix): int
    {
        $mode = $request->input($prefix . '_mode');
        $imageField = $prefix . '_image';

        if ($mode === 'new') {
            $company = Company::firstOrCreate(['name' => $request->input($prefix . '_name')]);

            if ($request->hasFile($imageField)) {
                $company->image = $request->file($imageField)->store('companies', 'public');
                $company->save();
            }

            return $company->id;
        }

        $company = Company::findOrFail($request->input($prefix . '_existing_id'));

        if ($request->hasFile($imageField)) {
            $company->image = $request->file($imageField)->store('companies', 'public');
            $company->save();
        }

        return $company->id;
    }
}
