
  <section>
    <div class="container py-5 mt-3 text-center align-items-center position-relative">
      <h1 class="mb-5 text-dark">{{ __('website.how_we_work') }}</h1>
      <p class="mb-4">{{ __('website.how_we_work_desc') }}</p>
      <a class="mb-5 packages-btn rounded-pill align-items-center" href="{{ route('packages.index') }}">
       {{ __('website.show_pachages') }}
    </a>

        <div class="m-0 mt-4 row m-sm-5">

    @foreach ($howWeWork as $index => $item)

        <div class="col-md-4">

            @if ($index == 0 || $index == 2)
                <div class="how-card rounded-4">
            @else
                <div class="how-card position-relative rounded-4">
            @endif

                    <img class="img-fluid"
                         src="{{ asset('uploads/general/' . $item->media) }}"
                         alt="{{ $item->question }}">

                    <div class="mx-2 how-content">
                        <h4 class="mt-4 text-dark rounded-pill fw-bold">
                            {{ $item->question }}
                        </h4>

                        <p class="mb-3">
                            {{ $item->answer }}
                        </p>
                    </div>

                </div>
        </div>

    @endforeach

</div>

  </section>
