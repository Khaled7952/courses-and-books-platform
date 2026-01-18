@extends('layouts.dashboard.app')

@section('title')
    إضافة قسم جديد
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
                                <a href="{{ route('dashboard.welcome') }}">لوحة التحكم</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.category.index') }}">الأقسام</a>
                            </li>
                            <li class="breadcrumb-item active">إضافة قسم جديد</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card --}}
        <div class="col-md-12">
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

                <div class="card-content collapse show">
                    <div class="card-body">

                        <form class="form" action="{{ route('dashboard.category.store') }}" method="POST">
                            @csrf

                            <div class="form-body">

                                <h4 class="form-section">
                                    <i class="la la-folder"></i> إضافة قسم جديد
                                </h4>

                                {{-- الحالة --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>الحالة</label>

                                        <div id="status-switch" class="btn-group" style="margin:10px">
                                            <a data-status="0" class="btn btn-default" onclick="setStatus(0)">لا</a>
                                            <a data-status="1" class="btn btn-default" onclick="setStatus(1)">نعم</a>
                                        </div>

                                        <input type="hidden" id="status-input" name="status"
                                               value="{{ old('status',1) }}">
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                {{-- الاسم + السلاج --}}
                                <div class="mt-2 row">

                                    <div class="col-md-6">
                                        <label>اسم التصنيف (عربي)</label>
                                        <input type="text" class="form-control border-primary"
                                               name="name"
                                               value="{{ old('name') }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>الرابط (Slug)</label>
                                        <input type="text" class="form-control border-primary"
                                               id="slug_ar"
                                               name="slug"
                                               value="{{ old('slug') }}"
                                               onchange="generateSlugFromTitle(this.value,'slug_ar')">
                                        @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>

                                {{-- الأب + الأيقونة --}}
                                <div class="mt-3 row">

                                    <div class="col-md-6">
                                        <label>القسم الرئيسي</label>
                                        <select class="form-control border-primary" name="parent_id">
                                            <option value="">بدون قسم أب</option>

                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>الأيقونة (Font Awesome)</label>
                                        <input type="text" class="form-control border-primary"
                                               name="icon"
                                               value="{{ old('icon') }}"
                                               placeholder="مثال: fa-solid fa-star">
                                        @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>

                                {{-- Meta Title --}}
                                <div class="mt-3 row">

                                    <div class="col-md-6">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control border-primary"
                                               name="meta_title"
                                               value="{{ old('meta_title') }}">
                                        @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label>Meta Description</label>
                                        <input type="text" class="form-control border-primary"
                                               name="meta_description"
                                               value="{{ old('meta_description') }}">
                                        @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>

                                {{-- Meta Keywords --}}
                                <div class="mt-3 row">
                                    <div class="col-md-12">
                                        <label>Meta Keywords</label>
                                        <input type="text" class="form-control border-primary"
                                               name="meta_keywords"
                                               value="{{ old('meta_keywords') }}">
                                        @error('meta_keywords') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- Actions --}}
                            <div class="mt-3 form-actions right">
                                <button type="button" class="btn btn-warning" onclick="window.history.back();">
                                    <i class="ft-x"></i> إلغاء
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> حفظ
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('UtilsJs/status-switch.js') }}"></script>
<script src="{{ asset('UtilsJs/generateSlugFromTitle.js') }}"></script>
<script src="{{ asset('UtilsJs/textLimiter.js') }}"></script>
@endsection
