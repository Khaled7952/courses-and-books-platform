@extends('layouts.dashboard.app')

@section('title')
    إضافة مقالة جديدة
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
                                    <a href="{{ route('dashboard.blog.index') }}">المقالات</a>
                                </li>
                                <li class="breadcrumb-item active">إضافة مقالة</li>
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

                            <form id="myForm" class="form" action="{{ route('dashboard.blog.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">

                                    <h4 class="form-section">
                                        <i class="la la-newspaper-o"></i> إضافة مقالة
                                    </h4>

                                    {{-- الحالة + القسم --}}
                                    <div class="row">

                                        {{-- الحالة --}}
                                        <div class="col-md-6">
                                            <label>الحالة</label>

                                            <div id="status-switch" class="btn-group" style="margin:10px">
                                                <a data-status="0" class="btn btn-default" onclick="setStatus(0)">لا</a>
                                                <a data-status="1" class="btn btn-default" onclick="setStatus(1)">نعم</a>
                                            </div>

                                            <input type="hidden" id="status-input" name="status"
                                                value="{{ old('status', 1) }}">
                                        </div>

                                        {{-- القسم --}}
                                        <div class="col-md-6">
                                            <label>القسم</label>
                                            <select name="category_id" class="form-control">
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- العنوان + السلاج --}}
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>عنوان المقال</label>
                                            <input type="text" class="form-control border-primary" name="title"
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label>الرابط (Slug)</label>
                                            <input type="text" id="slug_ar" class="form-control border-primary"
                                                name="slug" value="{{ old('slug') }}"
                                                onchange="generateSlugFromTitle(this.value,'slug_ar')">
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row">

                                        {{-- الوصف المختصر --}}
                                        <div class="col-md-12">
                                            <label>الوصف المختصر للمقال</label>
                                            <input type="text" class="form-control border-primary"
                                                name="short_description" value="{{ old('short_description') }}">
                                            @error('short_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>

                                    {{-- المحتوى --}}
                                    <div class="mt-2 row">
                                        <div class="col-md-12">
                                            <label>المحتوى</label>
                                            <textarea name="content" id="ckeditor_ar" cols="30" rows="15" class="ckeditor-config">{{ old('content') }}</textarea>
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- الصورة --}}
                                    <div class="mt-2 row">
                                        <div class="col-md-12">
                                            <label>الصورة</label>
                                            <input type="file" name="image" id="image" class="dropify">
                                        </div>
                                    </div>

                                    {{-- TAGIFY --}}
                                    <div class="mt-2 form-group">
                                        <label>الوسوم</label>
                                        <input id="tagInput" class="form-control" placeholder="أدخل الوسوم">
                                        <input type="hidden" id="tags-hidden" name="tags">
                                    </div>

                                    {{-- SEO --}}
                                    <div class="mt-2 row">
                                        <div class="col-md-6">
                                            <label>Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Meta Description</label>
                                            <input type="text" name="meta_description" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mt-2 row">
                                        <div class="col-md-12">
                                            <label>Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control">
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



@push('custom-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush


@section('scripts')
    <script src="{{ asset('UtilsJs/status-switch.js') }}"></script>
    <script src="{{ asset('UtilsJs/generateSlugFromTitle.js') }}"></script>
    <script src="{{ asset('UtilsJs/textLimiter.js') }}"></script>
    <script src="{{ asset('UtilsJs/summernote-config.js') }}"></script>

    <script src="{{ asset('UtilsJs/uploadimage-summernote.js') }}"></script>

    <script>
        function setupCKEditor(id, defaultDirection) {
            CKEDITOR.replace(id, {
                contentsLangDirection: defaultDirection,
                height: 400,
                on: {
                    instanceReady: function(event) {
                        const editor = event.editor;

                        setEditorDirection(editor, defaultDirection);

                        editor.on('contentDom', function() {
                            const editable = editor.editable();

                            editable.attachListener(editable, 'input', function() {
                                adjustDirectionBasedOnText(editable);
                            });

                            editable.attachListener(editable, 'paste', function() {
                                setTimeout(() => adjustDirectionBasedOnText(editable), 10);
                            });
                        });
                    }
                }
            });

            function setEditorDirection(editor, direction) {
                editor.editable().setAttribute('dir', direction);
                editor.editable().setStyle('text-align', direction === 'rtl' ? 'right' : 'left');
            }

            function adjustDirectionBasedOnText(editable) {
                const textContent = editable.getText().trim();

                if (/[\u0600-\u06FF]/.test(textContent)) {
                    // النص عربي
                    editable.setAttribute('dir', 'rtl');
                    editable.setStyle('text-align', 'right');
                } else {
                    // النص إنجليزي
                    editable.setAttribute('dir', 'ltr');
                    editable.setStyle('text-align', 'left');
                }
            }
        }

        setupCKEditor('ckeditor_ar', 'rtl');
        setupCKEditor('ckeditor_en', 'ltr');
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            console.log("Tagify script loaded");

            const input = document.querySelector('#tagInput');
            if (!input) {
                console.log("Input #tagInput NOT FOUND");
                return;
            }

            const tagify = new Tagify(input, {
                enforceWhitelist: true,
                whitelist: [],
                dropdown: {
                    enabled: 1,
                    maxItems: 10,
                    searchKeys: ['value']
                }
            });

            console.log("Tagify initialized");

            tagify.on('input', function(e) {
                console.log("Input typed:", e.detail.value);

                fetch(`{{ route('dashboard.tags.search') }}?search=${encodeURIComponent(e.detail.value)}`)
                    .then(res => res.json())
                    .then(list => {
                        console.log("API response:", list);

                        tagify.settings.whitelist = list.map(item => ({
                            id: item.id,
                            value: item.value
                        }));

                        tagify.dropdown.show(e.detail.value);
                    });
            });

            function syncHiddenInputs() {
                console.log("Sync Hidden Inputs fired");

                document.querySelectorAll('input[name="tags[]"]').forEach(el => el.remove());

                const ids = tagify.value.map(t => t.id);
                console.log("Selected IDs:", ids);

                const container = document.getElementById('tags-hidden').parentNode;

                ids.forEach(id => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'tags[]';
                    hidden.value = id;
                    container.appendChild(hidden);

                    console.log("Added hidden input for ID:", id);
                });
            }

            tagify.on('add', syncHiddenInputs);
            tagify.on('remove', syncHiddenInputs);

        });
    </script>
@endsection
