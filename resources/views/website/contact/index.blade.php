@extends('website.master')

{{-- @section('meta_title',
    $global_seo['gym food business']?->getTranslation('meta_title', app()->getLocale()) ??
        'Gym Food
    Business')
@section('meta_description', $global_seo['gym food business']?->getTranslation('meta_description', app()->getLocale()) ?? 'Business Solutions Description')
@section('meta_keywords', $global_seo['gym food business']?->getTranslation('meta_keywords', app()->getLocale()) ?? 'business catering, corporate meals') --}}

@section('content')

<section class="mt-5 contact">
    <div class="container">
        <h1 class="pt-5 text-center fw-bold text-primary">تواصل معنا</h1>
        <p class="mb-4 text-center text-secondary fs-2"> حسن نمط حياتك و اهدافك وما تريد ان تصبح عليه</p>

        <div class="container p-4 my-5 bg-white shadow rounded-4">
            <div class="row">
                <div class="col-12 col-sm-6 d-flex flex-column align-items-center">
                    <img class="mt-4 img-fluid me-5"
                         src="{{ asset('uploads/general/' . $settings->logo) }}"
                         alt="logo">
                </div>

                <div class="py-5 col-12 col-sm-6">
                    <ul class="list-unstyled ms-5">

                        <li class="py-2 list-unstyed-item">
                            <i class="fa-solid fa-envelope fa-lg contact-icon"></i>
                            <a href="mailto:{{ $settings->email }}" class="text-secondary" target="_blank">
                                {{ $settings->email }}
                            </a>
                        </li>

                        <li class="py-2 list-unstyed-item">
                            <i class="fa-brands fa-whatsapp fa-lg contact-icon"></i>
                            <a href="https://wa.me/{{ $settings->whatsapp ?? $settings->phone }}"
                               class="text-secondary" dir="ltr" target="_blank">
                                {{ $settings->phone }}
                            </a>
                        </li>

                        <li class="py-2 list-unstyed-item">
                            <i class="fa-solid fa-location-dot fa-lg contact-icon"></i>
                            <a href="#" class="text-secondary" target="_blank">
                                {{ $settings->address }}
                            </a>
                        </li>

                    </ul>

                    {{-- ✅ خليه زي ما انت كاتبه (وشغال) --}}
                    <div class="mt-5 col-12 col-md-6">
                        <ul class="list-inline text-end text-sm-end">

                            @if (!empty($settings->social_links))
                                @foreach ($settings->social_links as $social)
                                    <li class="list-inline-item">
                                        <a href="{{ $social['link'] }}"
                                           class="contact-icon text-dark fs-5"
                                           target="_blank"
                                           rel="noopener">
                                            <i class="{{ $social['icon'] }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
