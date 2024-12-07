@extends('tablar::page')

@section('title', __('users.title'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('users.title') }}</h2>
                </div>
                @can('create users')
                    <div class="col-auto ms-auto">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary me-2">
                            <i class="ti ti-plus me-2"></i>
                            {{ __('users.create') }}
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                        <tr>
                            <th>{{ __('users.fields.name') }}</th>
                            <th>{{ __('users.fields.email') }}</th>
                            <th>{{ __('users.fields.roles') }}</th>
                            <th class="w-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-blue text-bg-dark me-2">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        @can('edit users')
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="btn btn-icon btn-primary me-2">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete users')
                                            <form action="{{ route('admin.users.destroy', $user) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Sure?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-danger me-2">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    ...
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="card-footer pb-0">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
