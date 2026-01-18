@extends('website.master')

@push('custom-css')
<style>
    .error-section{
        min-height: 70vh;
        display:flex;
        align-items:center;
    }
    .error-box{
        text-align:center;
        margin:auto;
        max-width:650px;
    }
    .error-title{
        font-size: 110px;
        font-weight:900;
        color:#C92A2A;
        line-height:1;
    }
</style>
@endpush


@section('content')

<section class="container py-5 error-section" style="margin-top: 100px;">
    <div class="error-box">

        <div class="error-title">404!</div>

        <h2 class="mt-3 fw-bold text-dark">
            {{ app()->getLocale() == 'ar' ? 'للأسف.. الصفحة غير موجودة' : 'Oops... Page Not Found' }}
        </h2>

        <p class="mt-2 text-muted">
            {{ app()->getLocale() == 'ar'
            ? 'الصفحة التي تحاول الوصول إليها غير متاحة أو تم نقلها.'
            : 'The page you’re looking for may have been moved or doesn’t exist anymore.' }}
        </p>

      <div class="mt-4">
    <a href="{{ route('home') }}"
       class="px-4 py-2 text-white btn btn-select rounded-pill">
       {{ app()->getLocale() == 'ar' ? 'العودة إلى الرئيسية' : 'Back to Home' }}
    </a>
</div>


    </div>
</section>

@endsection
