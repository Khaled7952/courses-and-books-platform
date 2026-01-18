@extends('layouts.dashboard.app')
@section('title')
Edit Seo Tags
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.seo.index') }}">{{ __('dashboard.seo') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{$seo->page_name}}</li>
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
                            <ul class="list-inline mb-0">
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
                            <form id="myForm" class="form" action="{{ route('dashboard.seo.update', $seo->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">

                                    <h4 class="form-section"><i class="la la-new"></i>{{ __('dashboard.edit_meta_tags') }}</h4>
                                     <!-- Seo  ---------------------- -->

                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.meta_title_ar') }}</label>
                                                <input type="text" id="metatitlear" class="form-control border-primary"
                                                    name="meta_title_ar"
                                                     value="{{$seo->getTranslation('meta_title', 'ar')}}"
                                                    oninput="limitTextById('metatitlear', 70)"

                                                    placeholder="{{ __('dashboard.meta_title_ar') }}">
                                                    @error('meta_title_ar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.meta_title_en') }}</label>
                                                <input type="text" id="metatitleen" class="form-control border-primary"
                                                    name="meta_title_en"
                                                     value=" {{$seo->getTranslation('meta_title', 'en')}}"
                                                     oninput="limitTextById('metatitleen', 70)"

                                                    placeholder="{{ __('dashboard.meta_title_en') }}">
                                                    @error('meta_title_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.meta_description_ar') }}</label>
                                                <input type="text" id="metadescriptionar" class="form-control border-primary"
                                                    name="meta_description_ar"
                                                     value="{{$seo->getTranslation('meta_description', 'ar')}}"
                                                    oninput="limitTextById('metadescriptionar', 170)"
                                                    placeholder="{{ __('dashboard.meta_description_ar') }}">
                                                    @error('meta_description_ar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.meta_description_en') }}</label>
                                                <input type="text" id="metadescriptionen" class="form-control border-primary"
                                                    name="meta_description_en"
                                                     value="{{$seo->getTranslation('meta_description', 'en')}}"
                                                    oninput="limitTextById('metadescriptionen', 170)"
                                                    placeholder="{{ __('dashboard.meta_description_en') }}">
                                                    @error('meta_description_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.meta_keywords_ar') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                    name="meta_keywords_ar"  value="{{$seo->getTranslation('meta_keywords', 'ar')}}"
                                                    placeholder="{{ __('dashboard.meta_keywords_ar') }}">
                                            </div>
                                            @error('meta_keywords_ar')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('dashboard.meta_keywords_en') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                    name="meta_keywords_en"
                                                   value="{{$seo->getTranslation('meta_keywords', 'en')}}"
                                                    placeholder="{{ __('dashboard.meta_keywords_en') }}">
                                            </div>
                                            @error('meta_keywords_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>



                                </div>

                                <div class="form-actions right">
                                    <button type="button" class="btn btn-warning mr-1" onclick="window.history.back();">
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


