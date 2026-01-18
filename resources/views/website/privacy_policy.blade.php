@extends('website.master')

@section('meta_title', $global_seo['privacy policy']?->getTranslation('meta_title', app()->getLocale()) ?? 'Privacy Policy')
@section('meta_description', $global_seo['privacy policy']?->getTranslation('meta_description', app()->getLocale()) ?? 'Privacy policy details')
@section('meta_keywords', $global_seo['privacy policy']?->getTranslation('meta_keywords', app()->getLocale()) ?? 'privacy, policy, terms')

@push('custom-css')
    <style>

    </style>
@endpush

@section('content')


    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 fw-bold text-dark"
            style="margin-top: 100px">{{ __('website.privacy_policy') }}</h2>
            <div class="privacy-policy-content"
            style="margin: 20px 0 50px 0">
                {!! $settings->getTranslation('privacy_policy', app()->getLocale()) !!}
            </div>
        </div>
    </section>
@endsection
