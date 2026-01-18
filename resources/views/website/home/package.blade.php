 <!--------------------- Packages Section --------------------->

 <section class="py-5 bg-light">
     <div class="container">
         <span class="{{ app()->getLocale() == 'ar' ? 'float-end' : 'float-start' }}">
             <a class="btn btn-outline-primary rounded-pill" href="{{ route('packages.index') }}">
                 {{ __('website.discover_more') }}
             </a>
         </span>
         <h2 class="fw-bold text-dark">{{ $settings->packages_title }}</h2>
         <p>{{ $settings->packages_subtitle }}</p>


         <div class="container mt-5">
             <div class="row">
                 <div class="packages">

                     @foreach ($packages as $package)
                         <div class="diet-card-else me-3 open-package" data-id="{{ $package->id }}"
                            >

                             <div class="row">

                                 <div class="col-8">
                                     <h4 class="diet-title fw-bold text-dark">
                                         {{ $package->name }}
                                     </h4>

                                     <p class="diet-desc-else">
                                         {{ $package->short_description }}
                                     </p>

                                     <a href="javascript:void(0)" class="more-item">
                                         {{ __('website.more_details') }} ←
                                     </a>
                                 </div>

                                 <div class="col-2 offset-0 offset-sm-2 d-flex align-items-center">
                                     <div class="diet-icon">
                                         <img src="{{ asset('uploads/packages/' . $package->image) }}"
                                             alt="{{ $package->name }}" width="48" class="img-fluid rounded-circle">
                                     </div>
                                 </div>

                             </div>
                         </div>
                     @endforeach

                 </div>

             </div>
         </div>
     </div>
 </section>




