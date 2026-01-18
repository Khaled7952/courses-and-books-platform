@extends('website.master')



@push('custom-css')
    <style>


    </style>
@endpush

@section('content')
    <!------------------- Books Readed ------------------->

    <section class="mb-5 welcome-section">
        <div class="container">
            <div class="title-text">
                <h1>مرحباً بك</h1>
                <p>تابع تقدمك واستمر في رحلة التعلم والنمو النفسي الخاص بك</p>
            </div>

            <div class="row">
                <div class="mb-4 section-header d-flex align-items-center fs-2 fw-bold">
                    <div class="section-icon me-3"><svg width="66" height="66" viewBox="0 0 66 66" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.2"
                                d="M59.2746 14.3076V51.0988H40.879C38.7107 51.0988 36.6311 51.9601 35.0979 53.4934C33.5646 55.0267 32.7032 57.1062 32.7032 59.2746C32.7032 57.1062 31.8418 55.0267 30.3086 53.4934C28.7753 51.9601 26.6958 51.0988 24.5274 51.0988H6.13184V14.3076H24.5274C26.6958 14.3076 28.7753 15.169 30.3086 16.7023C31.8418 18.2355 32.7032 20.3151 32.7032 22.4834C32.7032 20.3151 33.5646 18.2355 35.0979 16.7023C36.6311 15.169 38.7107 14.3076 40.879 14.3076H59.2746Z"
                                fill="#4ED7F1" />
                            <path
                                d="M59.2746 12.2637H40.879C39.2925 12.2637 37.7277 12.6331 36.3086 13.3426C34.8896 14.0521 33.6552 15.0823 32.7032 16.3516C31.7513 15.0823 30.5169 14.0521 29.0978 13.3426C27.6788 12.6331 26.114 12.2637 24.5274 12.2637H6.13184C5.58975 12.2637 5.06987 12.479 4.68655 12.8623C4.30323 13.2456 4.08789 13.7655 4.08789 14.3076V51.0988C4.08789 51.6409 4.30323 52.1608 4.68655 52.5441C5.06987 52.9274 5.58975 53.1427 6.13184 53.1427H24.5274C26.1537 53.1427 27.7134 53.7888 28.8633 54.9387C30.0132 56.0887 30.6593 57.6483 30.6593 59.2746C30.6593 59.8167 30.8746 60.3366 31.2579 60.7199C31.6413 61.1032 32.1611 61.3185 32.7032 61.3185C33.2453 61.3185 33.7652 61.1032 34.1485 60.7199C34.5318 60.3366 34.7472 59.8167 34.7472 59.2746C34.7472 57.6483 35.3932 56.0887 36.5432 54.9387C37.6931 53.7888 39.2528 53.1427 40.879 53.1427H59.2746C59.8167 53.1427 60.3366 52.9274 60.7199 52.5441C61.1032 52.1608 61.3186 51.6409 61.3186 51.0988V14.3076C61.3186 13.7655 61.1032 13.2456 60.7199 12.8623C60.3366 12.479 59.8167 12.2637 59.2746 12.2637ZM24.5274 49.0548H8.1758V16.3516H24.5274C26.1537 16.3516 27.7134 16.9976 28.8633 18.1476C30.0132 19.2975 30.6593 20.8572 30.6593 22.4834V51.0988C28.8919 49.7689 26.7392 49.0513 24.5274 49.0548ZM57.2307 49.0548H40.879C38.6672 49.0513 36.5145 49.7689 34.7472 51.0988V22.4834C34.7472 20.8572 35.3932 19.2975 36.5432 18.1476C37.6931 16.9976 39.2528 16.3516 40.879 16.3516H57.2307V49.0548Z"
                                fill="#4ED7F1" />
                        </svg>
                    </div>
                    <span>مكتبتك</span>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-sm-4">
                    @if ($books->count() > 0)
                        @php $book = $books->first(); @endphp

                        <div class="border-0 shadow-sm card rounded-top rounded-4">
                            <div class="p-0 card-body">
                                <div class="mb-3 card-image">
                                    <img class="img-fluid rounded-2 w-100 justify-content-center"
                                        src="{{ asset('uploads/general/' . $book->cover_image) }}"
                                        alt="{{ $book->title }}">
                                </div>

                                <div class="card-content d-flex flex-column flex-grow-1">
                                    <div class="p-3">
                                        <h5 class="mb-2 text-dark fw-bold">{{ $book->title }}</h5>
                                        <p class="">{{ $book->subtitle }}</p>
                                    </div>

                                    <div class="mt-auto d-grid">
                                        <a class="py-3 btn btn-primary card-buttons rounded-0 rounded-top"
                                            href="{{ asset('uploads/pdfbooks/' . $book->file_pdf) }}"
                                            {{ $book->file_pdf ? 'download' : '' }}>
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M24.865 15.5406V23.829C24.865 24.1038 24.7559 24.3673 24.5616 24.5616C24.3673 24.7559 24.1038 24.865 23.829 24.865H1.03604C0.761267 24.865 0.497746 24.7559 0.30345 24.5616C0.109154 24.3673 0 24.1038 0 23.829V15.5406C0 15.2659 0.109154 15.0023 0.30345 14.808C0.497746 14.6138 0.761267 14.5046 1.03604 14.5046C1.31082 14.5046 1.57434 14.6138 1.76864 14.808C1.96293 15.0023 2.07209 15.2659 2.07209 15.5406V22.7929H22.7929V15.5406C22.7929 15.2659 22.9021 15.0023 23.0964 14.808C23.2907 14.6138 23.5542 14.5046 23.829 14.5046C24.1038 14.5046 24.3673 14.6138 24.5616 14.808C24.7559 15.0023 24.865 15.2659 24.865 15.5406ZM11.6995 16.2736C11.7957 16.37 11.91 16.4464 12.0358 16.4985C12.1615 16.5507 12.2964 16.5775 12.4325 16.5775C12.5687 16.5775 12.7035 16.5507 12.8293 16.4985C12.955 16.4464 13.0693 16.37 13.1655 16.2736L18.3457 11.0934C18.4908 10.9485 18.5896 10.7639 18.6296 10.5628C18.6697 10.3617 18.6492 10.1533 18.5707 9.96384C18.4922 9.77443 18.3593 9.61256 18.1887 9.49873C18.0182 9.3849 17.8178 9.32422 17.6127 9.32439H13.4686V1.03604C13.4686 0.761267 13.3594 0.497746 13.1651 0.30345C12.9708 0.109154 12.7073 0 12.4325 0C12.1577 0 11.8942 0.109154 11.6999 0.30345C11.5056 0.497746 11.3965 0.761267 11.3965 1.03604V9.32439H7.2523C7.04727 9.32422 6.84681 9.3849 6.67628 9.49873C6.50575 9.61256 6.37283 9.77443 6.29435 9.96384C6.21587 10.1533 6.19535 10.3617 6.23539 10.5628C6.27544 10.7639 6.37424 10.9485 6.5193 11.0934L11.6995 16.2736Z"
                                                    fill="white" />
                                            </svg>
                                            تحميل الكتاب
                                        </a>
                                        <button type="button" class="mt-2 btn btn-outline-primary w-100"
                                            data-bs-toggle="modal" data-bs-target="#rateBookModal"
                                            data-book-id="{{ $book->id }}" data-book-title="{{ $book->title }}"
                                            data-user-rating="{{ $bookRating ?? 0 }}">
                                            تقييم الكتاب
                                        </button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="border-0 shadow-sm card rounded-4">
                            <div class="p-4 text-center">
                                <h5 class="mb-0 text-dark fw-bold">لم تقم بشراء الكتاب إلى الآن</h5>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </section>

    <section class="your-courses">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="mb-4 section-header d-flex align-items-center fs-2 fw-bold">
                        <div class="section-icon me-3">
                            <svg width="66" height="66" viewBox="0 0 66 66" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.2"
                                    d="M55.1897 12.2644H10.2203C9.67821 12.2644 9.1583 12.4798 8.77496 12.8631C8.39163 13.2464 8.17627 13.7663 8.17627 14.3085V42.9253C8.17627 43.4675 8.39163 43.9874 8.77496 44.3707C9.1583 44.7541 9.67821 44.9694 10.2203 44.9694H55.1897C55.7318 44.9694 56.2517 44.7541 56.6351 44.3707C57.0184 43.9874 57.2338 43.4675 57.2338 42.9253V14.3085C57.2338 13.7663 57.0184 13.2464 56.6351 12.8631C56.2517 12.4798 55.7318 12.2644 55.1897 12.2644ZM28.6169 36.7932V20.4407L40.8813 28.6169L28.6169 36.7932Z"
                                    fill="#4ED7F1" />
                                <path
                                    d="M42.0158 26.9151L29.7515 18.7388C29.4436 18.5334 29.0856 18.4154 28.7159 18.3975C28.3462 18.3796 27.9786 18.4624 27.6522 18.6371C27.3259 18.8118 27.0532 19.0719 26.8631 19.3895C26.673 19.7071 26.5727 20.0704 26.573 20.4405V36.793C26.5727 37.1632 26.673 37.5264 26.8631 37.8441C27.0532 38.1617 27.3259 38.4217 27.6522 38.5964C27.9786 38.7711 28.3462 38.8539 28.7159 38.836C29.0856 38.8181 29.4436 38.7001 29.7515 38.4947L42.0158 30.3185C42.2962 30.1319 42.5261 29.8789 42.6852 29.582C42.8442 29.2851 42.9274 28.9536 42.9274 28.6168C42.9274 28.28 42.8442 27.9484 42.6852 27.6515C42.5261 27.3547 42.2962 27.1017 42.0158 26.9151ZM30.6611 32.9732V24.2731L37.197 28.6168L30.6611 32.9732ZM55.1898 10.2202H10.2204C9.13621 10.2202 8.09638 10.6509 7.32971 11.4176C6.56304 12.1843 6.13232 13.2241 6.13232 14.3083V42.9252C6.13232 44.0095 6.56304 45.0493 7.32971 45.816C8.09638 46.5826 9.13621 47.0133 10.2204 47.0133H55.1898C56.2741 47.0133 57.3139 46.5826 58.0806 45.816C58.8472 45.0493 59.278 44.0095 59.278 42.9252V14.3083C59.278 13.2241 58.8472 12.1843 58.0806 11.4176C57.3139 10.6509 56.2741 10.2202 55.1898 10.2202ZM55.1898 42.9252H10.2204V14.3083H55.1898V42.9252ZM59.278 53.1455C59.278 53.6876 59.0626 54.2076 58.6793 54.5909C58.2959 54.9742 57.776 55.1896 57.2339 55.1896H8.17639C7.63427 55.1896 7.11435 54.9742 6.73102 54.5909C6.34768 54.2076 6.13232 53.6876 6.13232 53.1455C6.13232 52.6034 6.34768 52.0835 6.73102 51.7002C7.11435 51.3168 7.63427 51.1015 8.17639 51.1015H57.2339C57.776 51.1015 58.2959 51.3168 58.6793 51.7002C59.0626 52.0835 59.278 52.6034 59.278 53.1455Z"
                                    fill="#4ED7F1" />
                            </svg>
                        </div>
                        <span>دوراتك</span>
                    </div>
                </div>
            </div>

            <div class="row">
                @if ($courses->count() > 0)
                    @foreach ($courses as $course)
                        <div class="mb-5 col-12">
                            <div class="card card-body">

                                <div class="row">
                                    <div class="col-12 col-sm-3">
                                        <div class="card-image">
                                            <img src="{{ asset('uploads/general/' . $course->image) }}"
                                                alt="{{ $course->title }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-9 d-flex align-items-center">
                                        <div class="card-content">
                                            <div>
                                                <h3 class="mb-3 card-title">{{ $course->title }}</h3>
                                                <p class="card-desc">
                                                    {!! $course->description !!}
                                                </p>
                                            </div>

                                            @php
                                                $whatsappNumber = preg_replace('/\D/', '', $settings->whatsapp);
                                                $message =
                                                    'لقد قمت بشراء الدورة: ' .
                                                    $course->title .
                                                    ' وأرغب بإرسال الفيديوهات الخاصة بها من طرفكم.';
                                                $whatsappLink =
                                                    "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
                                            @endphp
                                            <div class="my-3 btn-wrapper">
                                                <a href="{{ $whatsappLink }}" class="btn btn-primary me-3">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.3044 13.6153L16.4606 14.6916C16.3584 15.2023 16.0822 15.6617 15.679 15.9915C15.2759 16.3213 14.7708 16.501 14.25 16.5C12.4604 16.498 10.7447 15.7862 9.47922 14.5208C8.21378 13.2554 7.50198 11.5396 7.5 9.75003C7.49985 9.22983 7.67997 8.72565 8.00968 8.32329C8.3394 7.92093 8.79835 7.64524 9.30844 7.54315L10.3847 9.6994L9.46875 11.0625C9.40031 11.1652 9.35825 11.2832 9.34631 11.406C9.33437 11.5288 9.35292 11.6527 9.40031 11.7666C9.93692 13.042 10.9515 14.0565 12.2269 14.5932C12.3411 14.6426 12.466 14.6629 12.59 14.6521C12.7141 14.6413 12.8335 14.5998 12.9375 14.5313L14.3044 13.6153Z"
                                                            fill="#090909" />
                                                        <path
                                                            d="M21.75 12C21.7504 13.6833 21.3149 15.3381 20.486 16.8032C19.6572 18.2683 18.4631 19.4938 17.02 20.3605C15.577 21.2272 13.9341 21.7055 12.2514 21.7489C10.5686 21.7923 8.9033 21.3993 7.4175 20.6082L4.22531 21.6722C3.96102 21.7604 3.6774 21.7731 3.40624 21.7092C3.13509 21.6452 2.88711 21.5069 2.69011 21.3099C2.49311 21.1129 2.35486 20.8649 2.29087 20.5938C2.22688 20.3226 2.23967 20.039 2.32781 19.7747L3.39187 16.5825C2.69639 15.2749 2.30793 13.8261 2.256 12.3459C2.20406 10.8658 2.49001 9.39328 3.09213 8.04015C3.69425 6.68703 4.59672 5.48885 5.73105 4.53658C6.86537 3.58431 8.20173 2.90298 9.63869 2.54429C11.0756 2.1856 12.5754 2.15899 14.0242 2.46647C15.473 2.77395 16.8327 3.40745 18.0001 4.31888C19.1675 5.2303 20.1119 6.3957 20.7616 7.72662C21.4114 9.05753 21.7494 10.519 21.75 12Z"
                                                            fill="#FFFDFD" fill-opacity="0.95" />
                                                    </svg>
                                                    استلم الفيديوهات الآن
                                                </a>

                                                @if ($course->file_pdf)
                                                    <a href="{{ asset('uploads/pdfbooks/' . $course->file_pdf) }}"
                                                        class="btn btn-outline-primary" download>
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.2" d="M19.5 8.25H14.25V3L19.5 8.25Z"
                                                                fill="#4ED7F1" />
                                                            <path
                                                                d="M21 14.25C21 14.4489 20.921 14.6397 20.7803 14.7803C20.6397 14.921 20.4489 15 20.25 15H18V16.5H19.5C19.6989 16.5 19.8897 16.579 20.0303 16.7197C20.171 16.8603 20.25 17.0511 20.25 17.25C20.25 17.4489 20.171 17.6397 20.0303 17.7803C19.8897 17.921 19.6989 18 19.5 18H18V19.5C18 19.6989 17.921 19.8897 17.7803 20.0303C17.6397 20.171 17.4489 20.25 17.25 20.25C17.0511 20.25 16.8603 20.171 16.7197 20.0303C16.579 19.8897 16.5 19.6989 16.5 19.5V14.25C16.5 14.0511 16.579 13.8603 16.7197 13.7197C16.8603 13.579 17.0511 13.5 17.25 13.5H20.25C20.4489 13.5 20.6397 13.579 20.7803 13.7197C20.921 13.8603 21 14.0511 21 14.25ZM8.625 16.125C8.625 16.8212 8.34844 17.4889 7.85616 17.9812C7.36387 18.4734 6.69619 18.75 6 18.75H5.25V19.5C5.25 19.6989 5.17098 19.8897 5.03033 20.0303C4.88968 20.171 4.69891 20.25 4.5 20.25C4.30109 20.25 4.11032 20.171 3.96967 20.0303C3.82902 19.8897 3.75 19.6989 3.75 19.5V14.25C3.75 14.0511 3.82902 13.8603 3.96967 13.7197C4.11032 13.579 4.30109 13.5 4.5 13.5H6C6.69619 13.5 7.36387 13.7766 7.85616 14.2688C8.34844 14.7611 8.625 15.4288 8.625 16.125ZM7.125 16.125C7.125 15.8266 7.00647 15.5405 6.7955 15.3295C6.58452 15.1185 6.29837 15 6 15H5.25V17.25H6C6.29837 17.25 6.58452 17.1315 6.7955 16.9205C7.00647 16.7095 7.125 16.4234 7.125 16.125ZM15.375 16.875C15.375 17.7701 15.0194 18.6285 14.3865 19.2615C13.7535 19.8944 12.8951 20.25 12 20.25H10.5C10.3011 20.25 10.1103 20.171 9.96967 20.0303C9.82902 19.8897 9.75 19.6989 9.75 19.5V14.25C9.75 14.0511 9.82902 13.8603 9.96967 13.7197C10.1103 13.579 10.3011 13.5 10.5 13.5H12C12.8951 13.5 13.7535 13.8556 14.3865 14.4885C15.0194 15.1215 15.375 15.9799 15.375 16.875ZM13.875 16.875C13.875 16.3777 13.6775 15.9008 13.3258 15.5492C12.9742 15.1975 12.4973 15 12 15H11.25V18.75H12C12.4973 18.75 12.9742 18.5525 13.3258 18.2008C13.6775 17.8492 13.875 17.3723 13.875 16.875ZM3.75 10.5V3.75C3.75 3.35218 3.90804 2.97064 4.18934 2.68934C4.47064 2.40804 4.85218 2.25 5.25 2.25H14.25C14.3485 2.24992 14.4461 2.26926 14.5371 2.3069C14.6282 2.34454 14.7109 2.39975 14.7806 2.46938L20.0306 7.71938C20.1003 7.78908 20.1555 7.87182 20.1931 7.96286C20.2307 8.05391 20.2501 8.15148 20.25 8.25V10.5C20.25 10.6989 20.171 10.8897 20.0303 11.0303C19.8897 11.171 19.6989 11.25 19.5 11.25C19.3011 11.25 19.1103 11.171 18.9697 11.0303C18.829 10.8897 18.75 10.6989 18.75 10.5V9H14.25C14.0511 9 13.8603 8.92098 13.7197 8.78033C13.579 8.63968 13.5 8.44891 13.5 8.25V3.75H5.25V10.5C5.25 10.6989 5.17098 10.8897 5.03033 11.0303C4.88968 11.171 4.69891 11.25 4.5 11.25C4.30109 11.25 4.11032 11.171 3.96967 11.0303C3.82902 10.8897 3.75 10.6989 3.75 10.5ZM15 7.5H17.6897L15 4.81031V7.5Z"
                                                                fill="#4ED7F1" />
                                                        </svg>
                                                        محتوى الدورة (pdf)
                                                    </a>
                                                @endif
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#rateCourseModal"
                                                    data-course-id="{{ $course->id }}"
                                                    data-course-title="{{ $course->title }}"
                                                    data-user-rating="{{ $course->user_rating ?? 0 }}"
                                                    data-user-comment="{{ $course->user_comment ?? '' }}">
                                                    تقييم الدورة
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="border-0 shadow-sm card rounded-4">
                            <div class="p-4 text-center">
                                <h5 class="mb-0 text-dark fw-bold">لم تقم بشراء أي دورة إلى الآن</h5>
                            </div>
                        </div>
                    </div>
                @endif
            </div>



        </div>
    </section>

    {{-- تقييم الكتاب --}}
    <div class="modal fade" id="rateBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="rateBookTitle">تقييم الكتاب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="rateBookForm" action="">
                    @csrf

                    <div class="text-center modal-body">
                        <input type="hidden" name="book_id" id="bookIdInput" value="">
                        <input type="hidden" name="rating" id="ratingInput" value="0">

                        <div class="gap-2 d-flex justify-content-center fs-1" id="starsWrapper" style="cursor:pointer;">
                            <span class="star text-warning" data-value="1">☆</span>
                            <span class="star text-warning" data-value="2">☆</span>
                            <span class="star text-warning" data-value="3">☆</span>
                            <span class="star text-warning" data-value="4">☆</span>
                            <span class="star text-warning" data-value="5">☆</span>
                        </div>

                        <p class="mt-3 text-secondary" id="ratingText">اختر تقييمك</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ التقييم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--  تقييم الدورة --}}
    <div class="modal fade" id="rateCourseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="rateCourseTitle">تقييم الدورة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="rateCourseForm">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="rating" id="courseRatingInput" value="0">

                        <div class="text-center">
                            <div class="gap-2 d-flex justify-content-center fs-1" id="courseStarsWrapper"
                                style="cursor:pointer;">
                                <span class="course-star" data-value="1">☆</span>
                                <span class="course-star" data-value="2">☆</span>
                                <span class="course-star" data-value="3">☆</span>
                                <span class="course-star" data-value="4">☆</span>
                                <span class="course-star" data-value="5">☆</span>
                            </div>

                            <p class="mt-3 text-secondary" id="courseRatingText">اختر تقييمك</p>
                        </div>

                        <div class="mt-3">
                            <label class="mb-2 fw-bold">تعليقك (اختياري)</label>
                            <textarea name="comment" id="courseCommentInput" class="form-control" rows="4"
                                placeholder="اكتب تعليقك هنا..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ التقييم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection



@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('rateBookModal');
            const rateForm = document.getElementById('rateBookForm');
            const bookIdInput = document.getElementById('bookIdInput');
            const ratingInput = document.getElementById('ratingInput');
            const rateTitle = document.getElementById('rateBookTitle');
            const ratingText = document.getElementById('ratingText');
            const stars = [...document.querySelectorAll('#starsWrapper .star')];

            function fillStars(value) {
                stars.forEach(star => {
                    const starValue = parseInt(star.dataset.value);
                    star.textContent = starValue <= value ? "★" : "☆";
                    star.style.color = starValue <= value ? "#f5c542" : "#999";
                });

                ratingText.textContent = value > 0 ? `تقييمك: ${value} من 5` : "اختر تقييمك";
                ratingInput.value = value;
            }

            // Hover preview
            stars.forEach(star => {
                star.addEventListener('mouseenter', function() {
                    const hoverValue = parseInt(this.dataset.value);
                    fillStars(hoverValue);
                });

                star.addEventListener('mouseleave', function() {
                    const currentValue = parseInt(ratingInput.value) || 0;
                    fillStars(currentValue);
                });
            });

            // Click select rating
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.dataset.value);
                    fillStars(value);
                });
            });

            // When modal opens
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const bookId = button.getAttribute('data-book-id');
                const bookTitle = button.getAttribute('data-book-title');
                const userRating = parseInt(button.getAttribute('data-user-rating')) || 0;

                rateTitle.textContent = `تقييم الكتاب: ${bookTitle}`;
                bookIdInput.value = bookId;

                // ✅ نفس route بتاعك
                rateForm.action = "{{ url('profile/book') }}/" + bookId + "/rate";

                fillStars(userRating);
            });

            // Validation before submit
            rateForm.addEventListener('submit', function(e) {
                if (parseInt(ratingInput.value) < 1) {
                    e.preventDefault();
                    alert("من فضلك اختر تقييم من 1 إلى 5 ⭐");
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modal = document.getElementById('rateCourseModal');
            const rateForm = document.getElementById('rateCourseForm');

            const ratingInput = document.getElementById('courseRatingInput');
            const commentInput = document.getElementById('courseCommentInput');

            const rateTitle = document.getElementById('rateCourseTitle');
            const ratingText = document.getElementById('courseRatingText');

            const stars = [...document.querySelectorAll('#courseStarsWrapper .course-star')];

            function fillStars(value) {
                stars.forEach(star => {
                    const starValue = parseInt(star.dataset.value);
                    star.textContent = starValue <= value ? "★" : "☆";
                    star.style.color = starValue <= value ? '#f5c542' : '#999';
                });

                ratingText.textContent = value > 0 ? `تقييمك: ${value} من 5` : "اختر تقييمك";
                ratingInput.value = value;
            }

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    fillStars(parseInt(this.dataset.value));
                });
            });

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const courseId = button.getAttribute('data-course-id');
                const courseTitle = button.getAttribute('data-course-title');
                const userRating = parseInt(button.getAttribute('data-user-rating')) || 0;
                const userComment = button.getAttribute('data-user-comment') || '';

                rateTitle.textContent = `تقييم الدورة: ${courseTitle}`;

                rateForm.action = "{{ url('profile/course') }}/" + courseId + "/rate";

                commentInput.value = userComment;
                fillStars(userRating);
            });

            rateForm.addEventListener('submit', function(e) {
                if (parseInt(ratingInput.value) < 1) {
                    e.preventDefault();
                    alert('من فضلك اختر تقييم من 1 إلى 5');
                }
            });

        });
    </script>

@endpush
