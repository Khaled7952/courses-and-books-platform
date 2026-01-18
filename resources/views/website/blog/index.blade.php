@extends('website.master')

{{-- @section('meta_title',
    $global_seo['gym food business']?->getTranslation('meta_title', app()->getLocale()) ??
        'Gym Food
    Business')
@section('meta_description', $global_seo['gym food business']?->getTranslation('meta_description', app()->getLocale()) ?? 'Business Solutions Description')
@section('meta_keywords', $global_seo['gym food business']?->getTranslation('meta_keywords', app()->getLocale()) ?? 'business catering, corporate meals') --}}


@push('custom-css')
@endpush


@section('content')
    <section class="blog-section">
        <div class="container">
            <h1 class="mb-5 fs-1 fw-bold text-dark">
                المقالات
            </h1>
        </div>

        @if ($featuredArticle)
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="overflow-hidden img-fluid rounded-top-5">
                            <img src="{{ asset('uploads/general/' . $featuredArticle->image) }}"
                                alt="{{ $featuredArticle->title }}" class="w-100">
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="card-content d-flex flex-column flex-grow-1">
                            <div class="p-3 flex-grow-1">

                                <p class="mt-2 date text-secondary fs-4">
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.1719 0.924723H8.78487V0.462361C8.78487 0.339735 8.73615 0.222132 8.64944 0.135422C8.56273 0.0487129 8.44513 0 8.3225 0C8.19988 0 8.08227 0.0487129 7.99556 0.135422C7.90886 0.222132 7.86014 0.339735 7.86014 0.462361V0.924723H3.23653V0.462361C3.23653 0.339735 3.18782 0.222132 3.10111 0.135422C3.0144 0.0487129 2.89679 0 2.77417 0C2.65154 0 2.53394 0.0487129 2.44723 0.135422C2.36052 0.222132 2.31181 0.339735 2.31181 0.462361V0.924723H0.924723C0.679471 0.924723 0.444264 1.02215 0.270845 1.19557C0.0974258 1.36899 0 1.60419 0 1.84945V11.0967C0 11.3419 0.0974258 11.5771 0.270845 11.7505C0.444264 11.924 0.679471 12.0214 0.924723 12.0214H10.1719C10.4172 12.0214 10.6524 11.924 10.8258 11.7505C10.9992 11.5771 11.0967 11.3419 11.0967 11.0967V1.84945C11.0967 1.60419 10.9992 1.36899 10.8258 1.19557C10.6524 1.02215 10.4172 0.924723 10.1719 0.924723ZM10.1719 3.69889H0.924723V1.84945H2.31181V2.31181C2.31181 2.43443 2.36052 2.55204 2.44723 2.63875C2.53394 2.72546 2.65154 2.77417 2.77417 2.77417C2.89679 2.77417 3.0144 2.72546 3.10111 2.63875C3.18782 2.55204 3.23653 2.43443 3.23653 2.31181V1.84945H7.86014V2.31181C7.86014 2.43443 7.90886 2.55204 7.99556 2.63875C8.08227 2.72546 8.19988 2.77417 8.3225 2.77417C8.44513 2.77417 8.56273 2.72546 8.64944 2.63875C8.73615 2.55204 8.78487 2.43443 8.78487 2.31181V1.84945H10.1719V3.69889Z"
                                            fill="#4ED7F1" />
                                    </svg>
                                    {{ $featuredArticle->created_at->translatedFormat('d F') }}
                                    /
                                    {{ $featuredArticle->category?->name ?? 'عام' }}
                                </p>

                                <h5 class="mb-3 text-dark fw-bold fs-3">
                                    {{ $featuredArticle->title }}
                                </h5>

                                <p class="text-secondary fs-5">
                                    {{ $featuredArticle->short_description }}
                                </p>
                            </div>

                            <div class="p-3 float-start">
                                <a class="btn btn-primary card-buttons"
                                    href="{{ route('blog.show', $featuredArticle->slug) }}">
                                    قراءة المقال
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>

    <section class="py-5 blogs-section">
    <div class="container my-3">
        <p class="pb-5 fs-5 fw-normal">لتبدأ رحلتنا سوياً نحو حياة أفضل</p>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($articles as $article)
                <div class="col-12 col-sm-4">
                    <div class="p-2 card-body rounded-4">
                        <div class="card-image">
                            <img class="img-fluid rounded-top-4 w-100 justify-content-center"
                                src="{{ asset('uploads/general/' . $article->image) }}" alt="{{ $article->title }}">
                        </div>
                        <div class="card-content d-flex flex-column flex-grow-1 bg-primary-10">
                            <div class="p-3 flex-grow-1">
                                <p class="mt-2 date text-secondary fs-4">
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.1719 0.924723H8.78487V0.462361C8.78487 0.339735 8.73615 0.222132 8.64944 0.135422C8.56273 0.0487129 8.44513 0 8.3225 0C8.19988 0 8.08227 0.0487129 7.99556 0.135422C7.90886 0.222132 7.86014 0.339735 7.86014 0.462361V0.924723H3.23653V0.462361C3.23653 0.339735 3.18782 0.222132 3.10111 0.135422C3.0144 0.0487129 2.89679 0 2.77417 0C2.65154 0 2.53394 0.0487129 2.44723 0.135422C2.36052 0.222132 2.31181 0.339735 2.31181 0.462361V0.924723H0.924723C0.679471 0.924723 0.444264 1.02215 0.270845 1.19557C0.0974258 1.36899 0 1.60419 0 1.84945V11.0967C0 11.3419 0.0974258 11.5771 0.270845 11.7505C0.444264 11.924 0.679471 12.0214 0.924723 12.0214H10.1719C10.4172 12.0214 10.6524 11.924 10.8258 11.7505C10.9992 11.5771 11.0967 11.3419 11.0967 11.0967V1.84945C11.0967 1.60419 10.9992 1.36899 10.8258 1.19557C10.6524 1.02215 10.4172 0.924723 10.1719 0.924723ZM10.1719 3.69889H0.924723V1.84945H2.31181V2.31181C2.31181 2.43443 2.36052 2.55204 2.44723 2.63875C2.53394 2.72546 2.65154 2.77417 2.77417 2.77417C2.89679 2.77417 3.0144 2.72546 3.10111 2.63875C3.18782 2.55204 3.23653 2.43443 3.23653 2.31181V1.84945H7.86014V2.31181C7.86014 2.43443 7.90886 2.55204 7.99556 2.63875C8.08227 2.72546 8.19988 2.77417 8.3225 2.77417C8.44513 2.77417 8.56273 2.72546 8.64944 2.63875C8.73615 2.55204 8.78487 2.43443 8.78487 2.31181V1.84945H10.1719V3.69889Z"
                                            fill="#4ED7F1" />
                                    </svg>
                                    {{ $article->created_at->translatedFormat('d F') }} /
                                    {{ $article->category?->name ?? 'عام' }}
                                </p>
                                <h5 class="mb-3 text-dark fw-bold fs-3">{{ $article->title }}</h5>
                                <p class="text-secondary fs-5">{{ $article->short_description }}</p>
                            </div>
                            <div class="p-3 float-start">
                                <a class="btn btn-primary card-buttons" href="{{ route('blog.show', $article->slug) }}">
                                    قراءة المقال
                                    <svg width="9" height="8" viewBox="0 0 9 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.78515 3.66056C8.78515 3.75764 8.74659 3.85075 8.67794 3.91939C8.6093 3.98804 8.5162 4.0266 8.41912 4.0266H1.24984L3.91962 6.69592C3.95363 6.72993 3.9806 6.7703 3.99901 6.81474C4.01742 6.85917 4.02689 6.90679 4.02689 6.95489C4.02689 7.00299 4.01742 7.05061 3.99901 7.09504C3.9806 7.13948 3.95363 7.17985 3.91962 7.21386C3.88561 7.24787 3.84524 7.27485 3.8008 7.29325C3.75637 7.31166 3.70874 7.32113 3.66065 7.32113C3.61255 7.32113 3.56493 7.31166 3.52049 7.29325C3.47606 7.27485 3.43569 7.24787 3.40168 7.21386L0.107353 3.91954C0.0733207 3.88554 0.0463223 3.84517 0.0279018 3.80073C0.00948131 3.7563 0 3.70867 0 3.66056C0 3.61246 0.00948131 3.56483 0.0279018 3.52039C0.0463223 3.47596 0.0733207 3.43559 0.107353 3.40159L3.40168 0.107269C3.47036 0.0385858 3.56352 -7.23696e-10 3.66065 0C3.75778 7.23696e-10 3.85094 0.0385858 3.91962 0.107269C3.9883 0.175952 4.02689 0.269107 4.02689 0.36624C4.02689 0.463372 3.9883 0.556527 3.91962 0.62521L1.24984 3.29453H8.41912C8.5162 3.29453 8.6093 3.33309 8.67794 3.40174C8.74659 3.47038 8.78515 3.56349 8.78515 3.66056Z"
                                                fill="white" />
                                        </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $articles->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</section>

@endsection
