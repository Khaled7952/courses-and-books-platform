@if(request()->routeIs('home'))

    <header class="home-header">
        <nav class="bg-transparent navbar navbar-expand-lg">
            <div class="container">

                {{-- ✅ Logo --}}
                <a class="mt-4 navbar-brand" href="{{ route('home') }}">
                    <img
                        src="{{ !empty($settings?->logo) ? asset('uploads/general/' . $settings->logo) : asset('asset/website/assets/images/logo.png') }}"
                        alt="Logo"
                        style="max-height: 60px; width: auto;"
                    >
                </a>

                {{-- ✅ Toggler --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- ✅ Menu --}}
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="gap-4 navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}"> الرئيسية</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.index') }}">الكتاب</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.index') }}">الدورات</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog.index') }}">المدونة</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">تواصل معنا</a>
                        </li>
                    </ul>
                </div>

                {{-- ✅ Buttons + Cart --}}
                <div class="gap-3 navbar-buttons me-5 d-flex align-items-center">

                    {{-- Cart --}}
                    <div class="navbar-order position-relative">
                        <a href="{{ route('cart.index') }}">
                            <img src="{{ asset('asset/website/assets/images/order.png') }}" alt="Cart">
                        </a>

                        <div class="navbar-cart-badge rounded-pill cart-count"
                             style="position:absolute; top:-8px; right:-10px;">
                            0
                        </div>
                    </div>

                    {{-- ✅ Auth Buttons --}}
                    @if(auth('customer')->check())

                    <a href="{{ route('profile') }}" class="btn btn-primary">
            الصفحة الشخصية
        </a>
                        <form action="{{ route('customer.logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="border-2 btn btn-outline-primary">
                                تسجيل الخروج
                            </button>
                        </form>
                    @else
                        <a href="{{ route('customer.login.show') }}" class="btn btn-primary">تسجيل الدخول</a>
                        <a href="{{ route('customer.register.show') }}" class="border-2 btn btn-outline-primary">انشاء حساب جديد</a>
                    @endif

                </div>
            </div>
        </nav>

        {{-- ✅ Slider يظهر في الهوم فقط --}}
        <section class="slider-cover">
            <div class="container position-relative h-100">
                <div class="row h-100">

                    <div class="col-12 col-sm-9 d-flex align-items-center">
                        <div class="slider-content">

                            <h1 class="slider-content-title w-75 text-start">
                               {{ $settings->hero_title }}
                            </h1>

                            <p class="slider-content-subtitle">
                               {{ $settings->hero_description }}
                            </p>

                            <div class="gap-4 slider-buttons d-flex">
                                <a href="{{ route('courses.index') }}" class="btn btn-primary">ابدأ الآن</a>
                                <a href="{{ route('contact.index') }}" class="border-2 btn btn-outline-primary">تواصل معنا</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-sm-3 row align-items-center">
                        <div class="degreesWrappar">
                            <div class="degrees">
                                <div><img class="img-fluid" src="{{ asset('asset/website/assets/images/AWARD.png') }}" alt=""></div>
                                <div><img class="img-fluid" src="{{ asset('asset/website/assets/images/AWARD.png') }}" alt=""></div>
                                <div><img class="img-fluid" src="{{ asset('asset/website/assets/images/AWARD.png') }}" alt=""></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </header>

@else

    {{-- ✅ هنا ممنوع تستخدم header عشان CSS بتاع الهوم بيضرب --}}
    <div class="inner-header">
        <nav class="bg-transparent navbar navbar-expand-lg">
            <div class="container">

                {{-- ✅ Logo --}}
                <a class="mt-4 navbar-brand" href="{{ route('home') }}">
                    <img
                        src="{{ !empty($settings?->logo) ? asset('uploads/general/' . $settings->logo) : asset('asset/website/assets/images/logo.png') }}"
                        alt="Logo"
                        style="max-height: 60px; width: auto;"
                    >
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="gap-4 navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">الرئيسية</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('book.index') }}">الكتاب</a>
                        </li>

                           <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.index') }}">الدورات</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog.index') }}">المدونة</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">تواصل معنا</a>
                        </li>

                    </ul>
                </div>

                {{-- ✅ Buttons + Cart --}}
                <div class="gap-3 navbar-buttons me-5 d-flex align-items-center">
                    <div class="navbar-order position-relative">
                        <a href="{{ route('cart.index') }}">
                            <img src="{{ asset('asset/website/assets/images/order.png') }}" alt="Cart">
                        </a>
                        <div class="navbar-cart-badge rounded-pill cart-count"
                             style="position:absolute; top:-8px; right:-10px;">
                            0
                        </div>
                    </div>

                    @if(auth('customer')->check())

                               <a href="{{ route('profile') }}" class="btn btn-primary">
            الصفحة الشخصية
        </a>
                        <form action="{{ route('customer.logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="border-2 btn btn-outline-primary">تسجيل الخروج</button>
                        </form>
                    @else
                        <a href="{{ route('customer.login.show') }}" class="btn btn-primary">تسجيل الدخول</a>
                        <a href="{{ route('customer.register.show') }}" class="border-2 btn btn-outline-primary">انشاء حساب جديد</a>
                    @endif
                </div>

            </div>
        </nav>

        {{-- ✅ line (زي التيمبلت الفرعي) --}}
        <div class="py-5 my-5 text-center line">
            <img class="img-fluid" src="{{ asset('asset/website/assets/images/line.png') }}" alt="">
        </div>
    </div>

@endif
