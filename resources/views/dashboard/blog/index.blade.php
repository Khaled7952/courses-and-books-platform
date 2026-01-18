@extends('layouts.dashboard.app')

@section('title')
    All Articles
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('dashboard.blog') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="card">

                <div class="card-header">
                    <div class="heading-elements">
                        <ul class="mb-0 list-inline">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-body">

                        <a href="{{ route('dashboard.blog.create') }}" class="mb-2 btn btn-primary">
                            {{ __('dashboard.add_new_blog') }}
                        </a>

                        <table class="table text-center table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard.article_name') }}</th>
                                    <th>{{ __('dashboard.category') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <th>{{ __('dashboard.operations') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        {{-- TITLE --}}
                                        <td>{{ $blog->title }}</td>

                                        {{-- CATEGORY --}}
                                        <td>
                                            {{ $blog->category->name ?? __('dashboard.no_category') }}
                                        </td>

                                        {{-- STATUS --}}
                                        <td>
                                            @if ($blog->status == 1)
                                                <button class="btn btn-success">
                                                        <i class="la la-check-circle"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger">
                                                        <i class="la la-times-circle"></i>
                                                    </button>
                                            @endif
                                        </td>

                                        {{-- OPERATIONS --}}
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown">
                                                    {{ __('dashboard.operations') }}
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a class="dropdown-item"
                                                       href="{{ route('dashboard.blog.edit', $blog->id) }}">
                                                        <i class="la la-edit"></i> {{ __('dashboard.edit') }}
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                       onclick="if(confirm('{{ __('dashboard.delete_blog') }}')){ document.getElementById('delete-form-{{ $blog->id }}').submit();}">
                                                        <i class="la la-trash"></i> {{ __('dashboard.delete') }}
                                                    </a>

                                                </div>
                                            </div>

                                            {{-- DELETE FORM --}}
                                            <form id="delete-form-{{ $blog->id }}"
                                                  action="{{ route('dashboard.blog.destroy', $blog->id) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('dashboard.no_data_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $blogs->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
