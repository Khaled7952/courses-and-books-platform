  <section class="py-1">
    <div class="container
    @if(app()->getLocale() == 'ar') app-bg @else app-bg1 @endif">
      <div class="row" id="apps">
        <div class="col-12 col-sm-6 ">

          <img class="mx-4 mb-2 mb-4" src="{{ asset('asset/website/assets/images/logo-dark.png') }}" alt="">

         <p class="mx-4 mb-5 fw-bold">
    @if(app()->getLocale() === 'ar')
        {!! implode(' ', array_slice(explode(' ', $settings->footer_slogan), 0, 2)) !!}
        <br>
        {!! implode(' ', array_slice(explode(' ', $settings->footer_slogan), 2)) !!}
    @else
        {{ $settings->footer_slogan }}
    @endif
</p>



          <h3 class="py-4 mx-4 text-white fs-2" id="download-txt">
           {{ __('website.donwnload_app_now') }}
          </h3>

          <li class="list-inline-item ms-4">
            <a href="{{ $settings->app_store_link }}" target="_blank">
              <img class="img-fluid" src="{{ asset('asset/website/assets/images/appstore.png') }}" alt="">
            </a>
          </li>

          <li class="list-inline-item">
            <a href="{{ $settings->google_play_link }}"
              target="_blank">
              <img class="img-fluid" src="{{ asset('asset/website/assets/images/googleplay.png') }}" alt="">
            </a>
          </li>
        </div>
        <div class="col-12 col-sm-6 text-end ">
          <img class="img-fluid" src="{{ asset('asset/website/assets/images/apps.png') }}" alt="">
        </div>
      </div>
    </div>
  </section>
