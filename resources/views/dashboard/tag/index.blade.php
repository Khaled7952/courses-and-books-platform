@extends('layouts.dashboard.app')

@section('title')
    الوسوم
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            {{-- Breadcrumb --}}
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.welcome') }}">
                                        لوحة التحكم
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">
                                    الوسوم
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content --}}
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

                            {{-- زر إضافة --}}
                            <a href="{{ route('dashboard.tag.create') }}" class="btn btn-primary">
                                إضافة وسم جديد
                            </a>

                            <br><br>

                            {{-- جدول --}}
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($tags as $tag)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>

                                            {{-- الاسم --}}
                                            <td>{{ $tag->name }}</td>

                                            {{-- الحالة --}}
                                            <td>
                                                @if ($tag->status == 1)
                                                    <button class="btn btn-success">
                                                        <i class="la la-check-circle"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger">
                                                        <i class="la la-times-circle"></i>
                                                    </button>
                                                @endif
                                            </td>

                                            {{-- عمليات --}}
                                            <td>
                                                <div class="dropdown float-md-left">
                                                    <button class="px-2 btn btn-danger dropdown-toggle"
                                                        type="button" data-toggle="dropdown">
                                                        العمليات
                                                    </button>

                                                    <div class="dropdown-menu">

                                                        {{-- Edit --}}
                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard.tag.edit', $tag->id) }}">
                                                            <i class="la la-edit"></i>
                                                            تعديل
                                                        </a>

                                                        <div class="dropdown-divider"></div>

                                                        {{-- Delete --}}
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="if(confirm('هل أنت متأكد من الحذف؟')){ document.getElementById('delete-form-{{ $tag->id }}').submit(); }">
                                                            <i class="la la-trash"></i>
                                                            حذف
                                                        </a>
                                                    </div>
                                                </div>

                                                {{-- Delete form --}}
                                                <form id="delete-form-{{ $tag->id }}"
                                                    action="{{ route('dashboard.tag.destroy', $tag->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                لا توجد بيانات
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            {{ $tags->links() }}

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
