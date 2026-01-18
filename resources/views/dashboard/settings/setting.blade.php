@extends('layouts.dashboard.app')
@section('title')
    الإعدادات
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
                                <li class="breadcrumb-item active">الإعدادات</li>
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

                            <form class="form" action="{{ route('dashboard.settings.update', $settings->id) }}"
                                  method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')


                                {{-- Tabs --}}
                                <ul class="nav nav-tabs nav-linetriangle">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#general">
                                            <i class="la la-cog"></i> الإعدادات العامة
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#static">
                                            <i class="la la-font"></i> محتوى الموقع
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#social">
                                            <i class="la la-share-alt"></i> السوشيال ميديا
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#privacy">
                                            <i class="la la-shield"></i> سياسة الخصوصية
                                        </a>
                                    </li>
                                </ul>


                                <div class="pt-3 tab-content">


                                    {{-- ================= GENERAL SETTINGS ================= --}}
                                    <div class="tab-pane active" id="general">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>الإيميل</label>
                                                <input type="email" name="email" class="form-control"
                                                       value="{{ $settings->email }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>رقم الجوال</label>
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{ $settings->phone }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>واتساب</label>
                                                <input type="text" name="whatsapp" class="form-control"
                                                       value="{{ $settings->whatsapp }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>العنوان</label>
                                                <input type="text" name="address" class="form-control"
                                                       value="{{ $settings->address }}">
                                            </div>
                                        </div>


                                        {{-- Logo --}}
                                        <div class="mt-3 row">
                                            <div class="col-md-6">
                                                <label>اللوجو</label>
                                                <input type="file" name="logo" class="form-control" id="logoInput">
                                            </div>

                                            <div class="text-center col-md-6">
                                                <label>معاينة اللوجو</label><br>

                                                <img id="logoPreview"
                                                     src="{{ $settings->logo ? asset('uploads/general/'.$settings->logo) : asset('default.png') }}"
                                                     style="width:120px;height:120px;object-fit:contain;border:1px solid #ccc;">
                                            </div>
                                        </div>

                                    </div>



                                    {{-- ================= STATIC CONTENT ================= --}}
                                    <div class="tab-pane" id="static">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>عنوان الهيدر</label>
                                                <input type="text" name="hero_title" class="form-control"
                                                       value="{{ $settings->hero_title }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label>نبذة قصيرة عن الكتاب</label>
                                                <textarea name="hero_description" rows="3" class="form-control">{{ $settings->hero_description }}</textarea>
                                            </div>
                                        </div>


                                        <div class="mt-3 row">

                                            <div class="col-md-6">
                                                <label>صورة الكتاب</label>
                                                <input type="file" name="hero_book_image" class="form-control" id="bookImageInput">
                                            </div>

                                            <div class="text-center col-md-6">
                                                <label>معاينة صورة الكتاب</label><br>

                                                <img id="bookImagePreview"
                                                     src="{{ $settings->hero_book_image ? asset('uploads/general/'.$settings->hero_book_image) : asset('default.png') }}"
                                                     style="width:150px;height:200px;object-fit:cover;border:1px solid #ccc;">
                                            </div>

                                        </div>


                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>عنوان البنر</label>
                                                <input type="text" name="banner_title" class="form-control"
                                                       value="{{ $settings->banner_title }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label>وصف البنر</label>
                                                <input type="text" name="banner_subtitle" class="form-control"
                                                       value="{{ $settings->banner_subtitle }}">
                                            </div>
                                        </div>


                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>نبذة عن الدكتورة (تظهر في الفوتر)</label>
                                                <textarea name="doctor_about" rows="4" class="form-control">{{ $settings->doctor_about }}</textarea>
                                            </div>
                                        </div>

                                    </div>




                                    {{-- ================= SOCIAL LINKS ================= --}}
                                    <div class="tab-pane" id="social">

                                        <div class="repeater-default">
                                            <div data-repeater-list="social_links">

                                                @forelse($settings->social_links ?? [] as $social)
                                                    <div data-repeater-item>
                                                        <div class="row">

                                                            <div class="col-md-5">
                                                                <label>الرابط</label>
                                                                <input type="text" name="link" class="form-control"
                                                                       value="{{ $social['link'] ?? '' }}">
                                                            </div>

                                                            <div class="col-md-5">
                                                                <label>الأيقونة (Fontawesome)</label>
                                                                <input type="text" name="icon" class="form-control"
                                                                       value="{{ $social['icon'] ?? '' }}">
                                                            </div>

                                                            <div class="mt-2 col-md-2">
                                                                <button type="button" data-repeater-delete
                                                                        class="btn btn-danger">
                                                                    حذف
                                                                </button>
                                                            </div>

                                                        </div>
                                                        <hr>
                                                    </div>

                                                @empty

                                                    <div data-repeater-item>
                                                        <div class="row">

                                                            <div class="col-md-5">
                                                                <label>الرابط</label>
                                                                <input type="text" name="link" class="form-control">
                                                            </div>

                                                            <div class="col-md-5">
                                                                <label>الأيقونة</label>
                                                                <input type="text" name="icon" class="form-control">
                                                            </div>

                                                            <div class="mt-2 col-md-2">
                                                                <button type="button" data-repeater-delete
                                                                        class="btn btn-danger">
                                                                    حذف
                                                                </button>
                                                            </div>

                                                        </div>
                                                        <hr>
                                                    </div>

                                                @endforelse

                                            </div>

                                            <button type="button" data-repeater-create class="mt-2 btn btn-primary">
                                                إضافة رابط جديد
                                            </button>
                                        </div>

                                    </div>




                                    {{-- ================= PRIVACY POLICY ================= --}}
                                    <div class="tab-pane" id="privacy">

                                        <label>سياسة الخصوصية</label>

                                        <textarea id="summernote_ar" name="privacy_policy" rows="10" class="form-control">{!! $settings->privacy_policy !!}</textarea>

                                    </div>




                                    {{-- Submit --}}
                                    <div class="mt-3 form-actions right">
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

    <script src="{{ asset('asset/dashboard/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('UtilsJs/repeater.js') }}"></script>

    <script>
        document.getElementById('logoInput').addEventListener('change', e => {
            if (e.target.files[0]) logoPreview.src = URL.createObjectURL(e.target.files[0]);
        });

        document.getElementById('bookImageInput').addEventListener('change', e => {
            if (e.target.files[0]) bookImagePreview.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>

    <script src="{{ asset('UtilsJs/summernote-config.js') }}"></script>
    <script src="{{ asset('UtilsJs/uploadimage-summernote.js') }}"></script>

@endsection
