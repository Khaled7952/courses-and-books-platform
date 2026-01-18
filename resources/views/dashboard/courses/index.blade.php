@extends('layouts.dashboard.app')

@section('title')
    جميع الدورات
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
                                <a href="{{ route('dashboard.welcome') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">الدورات</li>
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

                        {{-- Add New --}}
                        <a href="{{ route('dashboard.courses.create') }}" class="mb-2 btn btn-primary">
                            إضافة دورة جديدة
                        </a>


                        {{-- TABLE --}}
                        <table class="table text-center table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان الدورة</th>
                                    <th>السعر</th>
                                    <th>التقييم</th>
                                    <th>عدد المقيمين</th>
                                    <th>مميزة ؟</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($courses as $course)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        {{-- TITLE --}}
                                        <td>{{ $course->title }}</td>

                                        {{-- PRICE --}}
                                        <td>
                                            {{ number_format($course->price, 2) }}
                                            ر.س
                                        </td>

                                        {{-- AVG RATING --}}
                                        <td>
                                            {{ $course->rating_avg ?? 0 }}
                                        </td>

                                        {{-- COUNT --}}
                                        <td>
                                            {{ $course->rating_count ?? 0 }}
                                        </td>

                                        {{-- FEATURED --}}
                                        <td>
                                            @if($course->is_featured)
                                                <button class="btn btn-success btn-sm">
                                                    <i class="la la-check-circle"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-secondary btn-sm">
                                                    <i class="la la-minus-circle"></i>
                                                </button>
                                            @endif
                                        </td>


                                        {{-- OPERATIONS --}}
                                        <td>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    العمليات
                                                </button>

                                                <div class="dropdown-menu">

                                                    {{-- Edit --}}
                                                    <a class="dropdown-item"
                                                       href="{{ route('dashboard.courses.edit', $course->id) }}">
                                                        <i class="la la-edit"></i> تعديل
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    {{-- Delete --}}
                                                    <a class="dropdown-item text-danger"
                                                       href="javascript:void(0)"
                                                       onclick="if(confirm('هل تريد حذف هذه الدورة ؟')){ document.getElementById('delete-form-{{ $course->id }}').submit();}">
                                                        <i class="la la-trash"></i> حذف
                                                    </a>

                                                </div>
                                            </div>

                                            {{-- DELETE FORM --}}
                                            <form id="delete-form-{{ $course->id }}"
                                                  action="{{ route('dashboard.courses.destroy', $course->id) }}"
                                                  method="POST"
                                                  style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7">لا توجد بيانات</td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>


                        {{-- PAGINATION --}}
                        <div class="mt-3">
                            {{ $courses->links() }}
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
