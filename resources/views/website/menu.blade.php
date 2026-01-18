@extends('website.master')

@section('meta_title', $global_seo['menu']?->getTranslation('meta_title', app()->getLocale()) ?? 'Menu')
@section('meta_description', $global_seo['menu']?->getTranslation('meta_description', app()->getLocale()) ?? 'Menu
    Description')
@section('meta_keywords', $global_seo['menu']?->getTranslation('meta_keywords', app()->getLocale()) ?? 'menu, food,
    meals')


    @push('custom-css')
        <style>

        </style>
    @endpush

@section('content')
    <section class="py-5">
        <div class="container pt-5 mt-5">

            <h2 class="mb-4 fs-1 text-dark">
                {{ $settings->menu_title }}
            </h2>

            <p class="fs-5 fw-normal">
                {{ $settings->menu_subtitle }}
            </p>


            {{-- ============ CATEGORIES ========= --}}
            <ul class="my-5 nav nav-pills" role="tablist">

                {{-- ALL --}}
                <li class="nav-item bg-light rounded-pill me-2">
                    <button class="nav-link rounded-pill active category-btn" data-id="">
                        {{ __('website.all') ?? 'الجميع' }}
                    </button>
                </li>

                {{-- Dynamic Categories --}}
                @foreach ($categories as $category)
                    <li class="nav-item bg-light rounded-pill me-2" role="presentation">

                        <button class="nav-link rounded-pill category-btn me-2" id="pills-category-{{ $category->id }}-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-category-{{ $category->id }}" type="button"
                            role="tab" aria-controls="pills-category-{{ $category->id }}" aria-selected="false"
                            data-id="{{ $category->id }}">

                            <span class="gap-2 d-flex align-items-center">
                                <img src="{{ asset('uploads/general/' . $category->image) }}" width="24" alt="">
                                {{ $category->name }}
                            </span>

                        </button>

                    </li>
                @endforeach

            </ul>
        </div>


        {{-- ============ MEALS GRID ========= --}}
        <div class="container">
            <div class="row" id="meals-wrapper">
                @include('website.partials.partial_menu', ['meals' => $meals])
            </div>


            {{-- ============ LOAD MORE ========= --}}
            <div>
                <button id="load-more" class="px-4 py-2 mx-auto my-5 btn btn-outline-primary rounded-pill d-block">
                    {{ __('website.load_more') ?? 'مزيد من الوجبات' }}
                </button>
            </div>

    </section>
@endsection


@push('scripts')
    <script>
        let currentCategory = null;
        let offset = 8;
        let limit = 8;

        // change category
        $(document).on('click', '.category-btn', function() {

            $('.category-btn').removeClass('active');
            $(this).addClass('active');

            currentCategory = $(this).data('id') ?? null;
            offset = 0;

            $.get("{{ route('menu.load') }}", {
                    category_id: currentCategory,
                    offset: offset
                },
                function(res) {

                    $('#meals-wrapper').html(res);

                    offset = limit;

                    if ($.trim(res) === '')
                        $('#load-more').hide();
                    else
                        $('#load-more').show();
                }
            );
        });


        // load more
        $('#load-more').on('click', function() {

            $.get("{{ route('menu.load') }}", {
                    category_id: currentCategory,
                    offset: offset
                },
                function(res) {

                    if ($.trim(res) === '')
                        $('#load-more').hide();
                    else {
                        $('#meals-wrapper').append(res);
                        offset += limit;
                    }

                }
            );
        });
    </script>
@endpush
