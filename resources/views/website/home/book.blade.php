    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h2 class="my-5 text-dark"> {{ $book->title }} </h2>
                    </br>
                    <p>
                      {{ $book->subtitle }}
                    </p>
                    <span class="float-start">
                        <a class="mt-3 btn btn-primary rounded-2" href="{{ route('book.index') }}">
                            اكتشف المزيد
                        </a>
                    </span>
                </div>

                <div class="text-center col-12 col-sm-6">
                    <img class="img-fluid about-book"
                    src="{{ !empty($book?->cover_image) ? asset('uploads/general/' . $book->cover_image) : asset('asset/website/assets/images/about-book.png') }}"
                    alt="About Book">
                </div>
            </div>
        </div>
    </section>
