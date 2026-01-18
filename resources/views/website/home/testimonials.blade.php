<section class="py-5 bg-light">
    <div class="container">
        <p class="text-primary fs-6">
            {{ $settings->testimonials_subtitle }}
        </p>
        <h1 class="text-dark">
            {{ $settings->testimonials_title }}
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="reviews">

                @foreach ($testimonials as $testimonial)
                    <div>
                        <div class="mx-4 client-card ms-0">
                            <div class="client-header">
                                <img
                                    src="{{ asset('uploads/general/' . $testimonial->image) }}"
                                    alt="{{ $testimonial->name }}"
                                >

                                <div class="client-info">
                                    <h4>{{ $testimonial->name }}</h4>

                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-light' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <p>
                                {{ $testimonial->feedback }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
