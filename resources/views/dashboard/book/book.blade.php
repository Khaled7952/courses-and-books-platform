@extends('layouts.dashboard.app')

@section('title')
    بيانات الكتاب
@endsection

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
                            <li class="breadcrumb-item active">الكتاب</li>
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

                        <form class="form"
                              action="{{ route('dashboard.book.update', $book->id) }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')


                            {{-- Tabs --}}
                            <ul class="nav nav-tabs nav-linetriangle">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#general">
                                        <i class="la la-book"></i> بيانات عامة
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#details">
                                        <i class="la la-align-left"></i> الوصف والتفاصيل
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#images">
                                        <i class="la la-image"></i> صور الكتاب والملفات
                                    </a>
                                </li>

                            </ul>



                            <div class="pt-3 tab-content">



                                {{-- ================= GENERAL ================= --}}
                                <div class="tab-pane active" id="general">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>اسم الكتاب</label>
                                            <input type="text" name="title" class="form-control"
                                                   value="{{ $book->title }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>وصف صغير تحت الاسم</label>
                                            <input type="text" name="subtitle" class="form-control"
                                                   value="{{ $book->subtitle }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>السعر</label>
                                            <input type="number" step="0.01" name="price" class="form-control"
                                                   value="{{ $book->price }}">
                                        </div>

                                    </div>

                                </div>




                                {{-- ================= DETAILS ================= --}}
                                <div class="tab-pane" id="details">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <label>نبذة قصيرة عن الكتاب</label>
                                            <textarea name="short_description" rows="4" class="form-control">{{ $book->short_description }}</textarea>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <label>تفاصيل الكتاب</label>
                                            <textarea name="details" rows="6" class="form-control">{{ $book->details }}</textarea>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <label>نبذة عن الدكتورة</label>
                                            <textarea name="about_author" rows="4" class="form-control">{{ $book->about_author }}</textarea>
                                        </div>

                                    </div>

                                </div>




                                {{-- ================= IMAGES & PDF ================= --}}
                                <div class="tab-pane" id="images">

                                    <div class="row">

                                        {{-- Cover --}}
                                        <div class="col-md-4">
                                            <label>صورة الغلاف</label>
                                            <input type="file" name="cover_image" class="form-control" id="coverInput">

                                            <div class="mt-2 text-center">
                                                <label>معاينة</label><br>

                                                <img id="coverPreview"
                                                     src="{{ $book->cover_image ? asset('uploads/general/'.$book->cover_image) : asset('default.png') }}"
                                                     style="width:180px;height:230px;object-fit:cover;border:1px solid #ccc;">
                                            </div>
                                        </div>


                                        {{-- Back --}}
                                        <div class="col-md-4">
                                            <label>صورة خلفية الكتاب</label>
                                            <input type="file" name="back_image" class="form-control" id="backInput">

                                            <div class="mt-2 text-center">
                                                <label>معاينة</label><br>

                                                <img id="backPreview"
                                                     src="{{ $book->back_image ? asset('uploads/general/'.$book->back_image) : asset('default.png') }}"
                                                     style="width:180px;height:230px;object-fit:cover;border:1px solid #ccc;">
                                            </div>
                                        </div>


                                        {{-- ========= NEW PDF UPLOAD ========= --}}
                                        <div class="col-md-4">
                                            <label>ملف الكتاب (PDF / Doc / Epub)</label>
                                            <input type="file" name="file_pdf" class="form-control">

                                            @if($book->file_pdf)
                                                <div class="mt-2">
                                                    <a href="{{ asset('uploads/pdfbooks/'.$book->file_pdf) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-success">
                                                        تحميل الملف الحالي
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                </div>



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

<script>
    document.getElementById('coverInput').addEventListener('change', e => {
        if (e.target.files[0]) coverPreview.src = URL.createObjectURL(e.target.files[0]);
    });

    document.getElementById('backInput').addEventListener('change', e => {
        if (e.target.files[0]) backPreview.src = URL.createObjectURL(e.target.files[0]);
    });
</script>

@endsection
