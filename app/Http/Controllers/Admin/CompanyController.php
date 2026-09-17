<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view companies')->only('index');
        $this->middleware('permission:create companies')->only(['create', 'store']);
        $this->middleware('permission:edit companies')->only(['edit', 'update']);
        $this->middleware('permission:delete companies')->only('destroy');
    }

    public function index(): View
    {
        $companies = Company::withCount(['gamesAsDeveloper', 'gamesAsPublisher'])
            ->orderBy('name')
            ->paginate(15);

        return view('admin.companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('admin.companies.create');
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        Company::create($data);

        return redirect()->route('admin.companies.index')
            ->with('success', __('companies.messages.created'));
    }

    public function edit(Company $company): View
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($company->getRawOriginal('image')) {
                Storage::disk('public')->delete($company->getRawOriginal('image'));
            }
            $data['image'] = $request->file('image')->store('companies', 'public');
        }

        $company->update($data);

        return redirect()->route('admin.companies.index')
            ->with('success', __('companies.messages.updated'));
    }

    public function destroy(Company $company): RedirectResponse
    {
        if ($company->getRawOriginal('image')) {
            Storage::disk('public')->delete($company->getRawOriginal('image'));
        }

        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', __('companies.messages.deleted'));
    }
}
