@extends('layouts.dashboard.app')

@section('title','الأقسام')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        {{-- Breadcrumb --}}
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <div class="breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.welcome') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">الأقسام</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="content-body">

            <div class="card">

                <div class="card-content">
                    <div class="card-body">

                        {{-- زر إضافة --}}
                        <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">
                            إضافة قسم جديد
                        </a>

                        <br><br>

                        {{-- جدول --}}
                        <div class="table-responsive">
                            <table class="table text-center table-bordered">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم القسم</th>
                                        <th>القسم الأب</th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($categories as $category)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $category->name }}</td>

                                            <td>
                                                {{ $category->parent ? $category->parent->name : 'بدون' }}
                                            </td>

                                            <td>
                                                @if($category->status == 1)
                                                    <span class="badge badge-success">مفعل</span>
                                                @else
                                                    <span class="badge badge-danger">غير مفعل</span>
                                                @endif
                                            </td>

                                            <td>

                                                <div class="dropdown">
                                                    <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                        العمليات
                                                    </button>

                                                    <div class="dropdown-menu">

                                                        <a class="dropdown-item"
                                                           href="{{ route('dashboard.category.edit',$category->id) }}">
                                                            <i class="la la-edit"></i> تعديل
                                                        </a>

                                                        <div class="dropdown-divider"></div>

                                                        <a class="dropdown-item"
                                                           onclick="if(confirm('هل أنت متأكد من الحذف؟')) document.getElementById('delete-{{ $category->id }}').submit();"
                                                           href="#">
                                                            <i class="la la-trash"></i> حذف
                                                        </a>

                                                        <form id="delete-{{ $category->id }}"
                                                              action="{{ route('dashboard.category.destroy',$category->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="5">لا توجد بيانات</td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>
                        </div>

                        {{-- Pagination --}}
                        {{ $categories->links() }}

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
