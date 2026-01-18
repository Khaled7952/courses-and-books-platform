@extends('website.master')

@section('meta_title', $global_seo['packages']?->getTranslation('meta_title', app()->getLocale()) ?? 'Packages')
@section('meta_description', $global_seo['packages']?->getTranslation('meta_description', app()->getLocale()) ?? 'Packages Description')
@section('meta_keywords', $global_seo['packages']?->getTranslation('meta_keywords', app()->getLocale()) ?? 'packages, diet plans')

@push('custom-css')
<style>
    .diet-card{
        background:#fff;
        border-radius:20px;
        padding:20px;
        cursor:pointer;
        transition:.2s;
        box-shadow:0 5px 20px rgba(0,0,0,.05);
    }

    .diet-card:hover{
        transform:translateY(-4px);
    }

    .diet-title{
        font-size:20px;
    }

    .diet-desc{
        color:#777;
        font-size:14px;
    }

    .diet-icon{
        font-size:32px;
    }
</style>
@endpush


@section('content')

    <div id="modalContainer"></div>


    <section class="py-5 mt-5 text-dark">
        <div class="container py-5">

            <h1 class="fw-bold">
                {{ $settings->packages_title }}
            </h1>

            <p class="text-muted fs-6">
                {{ $settings->packages_subtitle }}
            </p>


            <div class="container mt-5">
                <div class="row g-4">

                    @foreach($packages as $package)

                        <div class="col-md-4">
                            <div class="diet-card open-package"
                                 data-id="{{ $package->id }}">

                                <div class="row">

                                   <div class="col-10 {{ app()->getLocale() == 'en' ? 'text-end' : '' }}">
                                        <h4 class="diet-title fw-bold text-dark">
                                            {{ $package->name }}
                                        </h4>

                                        <p class="diet-desc">
                                            {{ $package->short_description }}
                                        </p>

                                        <a href="javascript:void(0)" class="more-item">
                                            {{ __('website.more_details') }} ←
                                        </a>
                                    </div>

                                    <div class="col-2 d-flex align-items-center">
                                        <div class="diet-icon">
                                            <img src="{{ asset('uploads/packages/'.$package->image) }}"
                                                 width="48"
                                                 class="img-fluid rounded-circle">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </section>

@endsection



@push('scripts')
<script>
$(document).on('click','.open-package',function(){

    let id = $(this).data('id');

    $.get("{{ url('packages') }}/" + id + "/details", function(html){

        $('#modalContainer').html(html);

        let modalEl = document.getElementById('dietModal');

        let old = bootstrap.Modal.getInstance(modalEl);
        if(old) old.dispose();

        let modal = new bootstrap.Modal(modalEl);
        modal.show();
    });
});
</script>
@endpush
