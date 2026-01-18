@extends('layouts.dashboard.app')

@section('title')
    تعديل دورة
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.welcome') }}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">تعديل دورة</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">

                            @include('dashboard.includes.validations-errors')

                            <form class="form" action="{{ route('dashboard.courses.update', $course->id) }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')


                                <ul class="nav nav-tabs nav-linetriangle">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#general">
                                            <i class="la la-book"></i> بيانات عامة
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#details">
                                            <i class="la la-align-left"></i> وصف الدورة
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#benefits">
                                            <i class="la la-check-circle"></i> مميزات الدورة
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#media">
                                            <i class="la la-image"></i> صور وملفات
                                        </a>
                                    </li>

                                </ul>



                                <div class="pt-3 tab-content">



                                    <div class="tab-pane active" id="general">

                                        <div class="row">

                                            <div class="col-md-3">
                                                <label>عنوان الدورة</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ old('title', $course->title) }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>الرابط (Slug)</label>
                                                <input type="text" name="slug" class="form-control"
                                                    value="{{ old('slug', $course->slug) }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>السعر</label>
                                                <input type="number" step="0.01" name="price" class="form-control"
                                                    value="{{ old('price', $course->price) }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>هل الدورة مميزة؟</label>
                                                <input type="hidden" name="is_featured" value="0">

                                                <input type="checkbox" name="is_featured" value="1"
                                                    {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>

                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    value="{{ old('meta_title', $course->meta_title) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Meta Keywords</label>
                                                <input type="text" name="meta_keywords" class="form-control"
                                                    value="{{ old('meta_keywords', $course->meta_keywords) }}">
                                            </div>

                                        </div>


                                        <br>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <label>Meta Description</label>
                                                <input type="text" name="meta_description" class="form-control"
                                                    value="{{ old('meta_description', $course->meta_description) }}">
                                            </div>

                                        </div>

                                    </div>



                                    <div class="tab-pane" id="details">

                                        <label>وصف الدورة</label>

                                        <textarea name="description" id="summernote_ar" rows="6" class="form-control">
{{ old('description', $course->description) }}
</textarea>

                                    </div>



                                    <div class="tab-pane" id="benefits">

                                        <label>مميزات الدورة</label>

                                        <div class="repeater-default">
                                            <div data-repeater-list="benefits">

                                                @php
                                                    $oldBenefits = old('benefits');
                                                    $savedBenefits = $course->benefits ?? [];
                                                @endphp

                                                @if ($oldBenefits)
                                                    @foreach ($oldBenefits as $benefit)
                                                        <div data-repeater-item>
                                                            <div class="row">

                                                                <div class="col-md-10">
                                                                    <input type="text" name="benefit"
                                                                        class="form-control" placeholder="اكتب ميزة هنا"
                                                                        value="{{ $benefit['benefit'] ?? '' }}">
                                                                </div>

                                                                <div class="mt-1 col-md-2">
                                                                    <button type="button" data-repeater-delete
                                                                        class="btn btn-danger">
                                                                        حذف
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            <hr>
                                                        </div>
                                                    @endforeach
                                                @elseif($savedBenefits)
                                                    @foreach ($savedBenefits as $benefit)
                                                        <div data-repeater-item>
                                                            <div class="row">

                                                                <div class="col-md-10">
                                                                    <input type="text" name="benefit"
                                                                        class="form-control" placeholder="اكتب ميزة هنا"
                                                                        value="{{ $benefit['benefit'] ?? '' }}">
                                                                </div>

                                                                <div class="mt-1 col-md-2">
                                                                    <button type="button" data-repeater-delete
                                                                        class="btn btn-danger">
                                                                        حذف
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            <hr>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div data-repeater-item>
                                                        <div class="row">

                                                            <div class="col-md-10">
                                                                <input type="text" name="benefit" class="form-control"
                                                                    placeholder="اكتب ميزة هنا">
                                                            </div>

                                                            <div class="mt-1 col-md-2">
                                                                <button type="button" data-repeater-delete
                                                                    class="btn btn-danger">
                                                                    حذف
                                                                </button>
                                                            </div>

                                                        </div>
                                                        <hr>
                                                    </div>
                                                @endif

                                            </div>

                                            <button type="button" data-repeater-create class="mt-2 btn btn-primary">
                                                إضافة ميزة جديدة
                                            </button>

                                        </div>


                                    </div>



                                    <div class="tab-pane" id="media">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>صورة الدوره</label>
                                                <input type="file" name="image" class="form-control"
                                                    id="imageInput">

                                                <div class="mt-2 text-center">
                                                    <label>معاينة</label><br>

                                                    <img id="imagePreview"
                                                        src="{{ $course->image ? asset('uploads/general/' . $course->image) : asset('default.png') }}"
                                                        style="width:180px;height:150px;object-fit:cover;border:1px solid #ccc;">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <label>ملف ملخص الدوره (PDF) — اختياري</label>
                                                <input type="file" name="file_pdf" class="form-control">
                                            </div>

                                        </div>

                                    </div>


                                </div>



                                <div class="mt-3 form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> تحديث
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
    <script src="{{ asset('asset/dashboard/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('UtilsJs/repeater.js') }}"></script>

    <script>
        document.getElementById('imageInput').addEventListener('change', e => {
            if (e.target.files[0]) imagePreview.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>

    <script src="{{ asset('UtilsJs/summernote-config.js') }}"></script>
    <script src="{{ asset('UtilsJs/uploadimage-summernote.js') }}"></script>
@endsection
