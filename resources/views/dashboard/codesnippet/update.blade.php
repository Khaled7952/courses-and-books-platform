@extends('layouts.dashboard.app')
@section('title')
Add Code Snippet
@endsection
@push('custom-css')

<link rel="stylesheet" type="text/css" href="{{asset('asset/dashboard')}}/vendors/css/editors/codemirror.css">
<style>
    .CodeMirror {
        direction: ltr !important;
        text-align: left !important;
    }
</style>
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a></li>

                                <li class="breadcrumb-item active">{{ __('dashboard.snippet_code') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

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
                            {{-- @include('dashboard.includes.validations-errors') --}}
                            <form id="myForm" class="form" action="{{ route('dashboard.code-snippet.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">

                                    <h4 class="form-section"><i class="la la-new"></i>{{ __('dashboard.edit_meta_tags') }}</h4>
                                     <!-- Seo  ---------------------- -->

                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="header_code">{{ __('dashboard.header_code') }}</label>
                                                <textarea name="header_code" id="codeEditorHeader">{{ old('header_code', $codeSnippet->header_code ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="body_code">{{ __('dashboard.body_code') }}</label>
                                                <textarea name="body_code" id="codeEditorBody">{{ old('body_code', $codeSnippet->body_code ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="footer_code">{{ __('dashboard.footer_code') }}</label>
                                                <textarea name="footer_code" id="codeEditorFooter">{{ old('footer_code', $codeSnippet->footer_code ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="mr-1 btn btn-warning" onclick="window.history.back();">
                                        <i class="ft-x"></i> {{ __('dashboard.cancle') }}
                                    </button>
                                    <button id="saveButton" type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
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

@push('custom-js')
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/lib/codemirror.js"></script>

<!-- اللغات (Modes) اللي هنحتاجها -->
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/mode/css/css.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/mode/javascript/javascript.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/mode/xml/xml.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/mode/markdown/markdown.js"></script>

<!-- الإضافات المهمة (Addons) -->
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/edit/matchbrackets.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/edit/closebrackets.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/comment/comment.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/search/search.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/search/searchcursor.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/selection/active-line.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/selection/mark-selection.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/fold/foldcode.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/fold/foldgutter.js"></script>
<script src="{{asset('asset/dashboard')}}/vendors/js/editors/codemirror/addon/fold/brace-fold.js"></script>

<!-- تهيئة CodeMirror -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    var headerEditor = CodeMirror.fromTextArea(document.getElementById("codeEditorHeader"), {
        mode: "htmlmixed",
        theme: "default",
        lineNumbers: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        autoCloseTags: true,
        styleActiveLine: true,
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
    });

    var bodyEditor = CodeMirror.fromTextArea(document.getElementById("codeEditorBody"), {
        mode: "htmlmixed",
        theme: "default",
        lineNumbers: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        autoCloseTags: true,
        styleActiveLine: true,
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
    });

    var footerEditor = CodeMirror.fromTextArea(document.getElementById("codeEditorFooter"), {
        mode: "htmlmixed",
        theme: "default",
        lineNumbers: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        autoCloseTags: true,
        styleActiveLine: true,
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
    });
});

</script>
@endpush

