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

<!------------------- Main Content ------------------->
<section class="py-5">
    <div class="container">
        <div class="row">

            {{-- ================= المقال ================= --}}
            <div class="col-12 col-sm-7">
                <div class="p-2 card-body rounded-4">
                    <div class="card-image">

                        <h1 class="py-2">{{ $article->title }}</h1>

                        <p class="text-secondary fs-5">
                            مقالات / {{ $article->category?->name }}
                        </p>

                        <img src="{{ asset('uploads/general/' . $article->image) }}"
                             class="img-fluid rounded-top-4 w-100 justify-content-center"
                             alt="{{ $article->title }}">

                        @if($article->subtitle)
                            <h2 class="my-3 text-dark fw-bold fs-2">
                                {{ $article->subtitle }}
                            </h2>
                        @endif

                        <p class="mt-3 date fw-bold text-secondary fs-4">
                               <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.1719 0.924723H8.78487V0.462361C8.78487 0.339735 8.73615 0.222132 8.64944 0.135422C8.56273 0.0487129 8.44513 0 8.3225 0C8.19988 0 8.08227 0.0487129 7.99556 0.135422C7.90886 0.222132 7.86014 0.339735 7.86014 0.462361V0.924723H3.23653V0.462361C3.23653 0.339735 3.18782 0.222132 3.10111 0.135422C3.0144 0.0487129 2.89679 0 2.77417 0C2.65154 0 2.53394 0.0487129 2.44723 0.135422C2.36052 0.222132 2.31181 0.339735 2.31181 0.462361V0.924723H0.924723C0.679471 0.924723 0.444264 1.02215 0.270845 1.19557C0.0974258 1.36899 0 1.60419 0 1.84945V11.0967C0 11.3419 0.0974258 11.5771 0.270845 11.7505C0.444264 11.924 0.679471 12.0214 0.924723 12.0214H10.1719C10.4172 12.0214 10.6524 11.924 10.8258 11.7505C10.9992 11.5771 11.0967 11.3419 11.0967 11.0967V1.84945C11.0967 1.60419 10.9992 1.36899 10.8258 1.19557C10.6524 1.02215 10.4172 0.924723 10.1719 0.924723ZM10.1719 3.69889H0.924723V1.84945H2.31181V2.31181C2.31181 2.43443 2.36052 2.55204 2.44723 2.63875C2.53394 2.72546 2.65154 2.77417 2.77417 2.77417C2.89679 2.77417 3.0144 2.72546 3.10111 2.63875C3.18782 2.55204 3.23653 2.43443 3.23653 2.31181V1.84945H7.86014V2.31181C7.86014 2.43443 7.90886 2.55204 7.99556 2.63875C8.08227 2.72546 8.19988 2.77417 8.3225 2.77417C8.44513 2.77417 8.56273 2.72546 8.64944 2.63875C8.73615 2.55204 8.78487 2.43443 8.78487 2.31181V1.84945H10.1719V3.69889Z"
                                            fill="#4ED7F1" />
                                    </svg>
                           {{ $article->created_at->translatedFormat('d F Y') }}

                        </p>

                        <div class="text-justify text-secondary fs-5">
                            {!! $article->content !!}
                        </div>

                    </div>
                </div>
            </div>

            {{-- ================= السايدبار ================= --}}
            <div class="p-0 col-12 col-sm-4 offset-sm-1">

                {{-- ===== الأقسام ===== --}}
                <h4 class="mb-2 text-secondary">الأقسام</h4>

                <div class="shadow">
    <div class="mt-5 accordion">

        @foreach($categories as $category)
            <div class="accordion-item">

                <h2 class="accordion-header">
                    <a href="{{ route('blog.category.show',$category->id) }}"
                       class="accordion-button bg-primary-10 collapsed text-decoration-none text-dark fw-bold">

                        {{ $category->name }}

                    </a>
                </h2>

            </div>
        @endforeach

    </div>
</div>


                {{-- ===== أحدث المقالات ===== --}}
                <div class="mt-5">
                    <h3>أحدث المقالات</h3>
                </div>

                @foreach($latestArticles as $item)
                    <div class="my-3 row g-0">
                        <div class="col-3">
                            <img class="w-100 h-100 rounded-start-2"
                                 src="{{ asset('uploads/general/' . $item->image) }}"
                                 alt="{{ $item->title }}">
                        </div>

                        <div class="col-9">
                            <a href="{{ route('blog.show', $item->slug) }}"
                               class="p-3 card-content bg-primary-10 d-flex flex-column flex-grow-1 text-decoration-none">

                                <h5 class="text-dark fw-bold fs-5">
                                    {{ $item->title }}
                                </h5>

                                <p class="date text-secondary fs-5">
                                      <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.1719 0.924723H8.78487V0.462361C8.78487 0.339735 8.73615 0.222132 8.64944 0.135422C8.56273 0.0487129 8.44513 0 8.3225 0C8.19988 0 8.08227 0.0487129 7.99556 0.135422C7.90886 0.222132 7.86014 0.339735 7.86014 0.462361V0.924723H3.23653V0.462361C3.23653 0.339735 3.18782 0.222132 3.10111 0.135422C3.0144 0.0487129 2.89679 0 2.77417 0C2.65154 0 2.53394 0.0487129 2.44723 0.135422C2.36052 0.222132 2.31181 0.339735 2.31181 0.462361V0.924723H0.924723C0.679471 0.924723 0.444264 1.02215 0.270845 1.19557C0.0974258 1.36899 0 1.60419 0 1.84945V11.0967C0 11.3419 0.0974258 11.5771 0.270845 11.7505C0.444264 11.924 0.679471 12.0214 0.924723 12.0214H10.1719C10.4172 12.0214 10.6524 11.924 10.8258 11.7505C10.9992 11.5771 11.0967 11.3419 11.0967 11.0967V1.84945C11.0967 1.60419 10.9992 1.36899 10.8258 1.19557C10.6524 1.02215 10.4172 0.924723 10.1719 0.924723ZM10.1719 3.69889H0.924723V1.84945H2.31181V2.31181C2.31181 2.43443 2.36052 2.55204 2.44723 2.63875C2.53394 2.72546 2.65154 2.77417 2.77417 2.77417C2.89679 2.77417 3.0144 2.72546 3.10111 2.63875C3.18782 2.55204 3.23653 2.43443 3.23653 2.31181V1.84945H7.86014V2.31181C7.86014 2.43443 7.90886 2.55204 7.99556 2.63875C8.08227 2.72546 8.19988 2.77417 8.3225 2.77417C8.44513 2.77417 8.56273 2.72546 8.64944 2.63875C8.73615 2.55204 8.78487 2.43443 8.78487 2.31181V1.84945H10.1719V3.69889Z"
                                            fill="#4ED7F1" />
                                    </svg>
                                    {{ $item->created_at->translatedFormat('d F') }}
                                    /
                                    {{ $item->category?->name }}
                                </p>

                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>


@endsection
