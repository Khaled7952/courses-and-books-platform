@extends('website.master')

{{-- @section('meta_title',
    $global_seo['gym food business']?->getTranslation('meta_title', app()->getLocale()) ??
        'Gym Food
    Business')
@section('meta_description', $global_seo['gym food business']?->getTranslation('meta_description', app()->getLocale()) ?? 'Business Solutions Description')
@section('meta_keywords', $global_seo['gym food business']?->getTranslation('meta_keywords', app()->getLocale()) ?? 'business catering, corporate meals') --}}

@section('content')

    <div class="container mb-5">
        <h1 class="mb-5 row text-start fw-bold">محتويات السلة</h1>
    </div>

    <div class="container">
        {{-- ✅ الصف الرئيسي: Products 8 / Summary 4 --}}
        <div class="row gy-4">

            {{-- ✅ Products Column (8) --}}
            <div class="col-12 col-lg-7">

                {{-- ✅ Grid جوه الـ 8: 2 كارت جنب بعض --}}
                <div class="row gy-4">

                    @if (!empty($cart['items']) && count($cart['items']) > 0)
                        @foreach ($cart['items'] as $item)
                            {{-- ✅ كل منتج ياخد نص الـ 8 => col-lg-6 (يعني 2 جنب بعض) --}}
                            <div class="col-12 col-sm-6 col-lg-6 cart-item-card" data-id="{{ $item['id'] }}">
                                <div class="border-0 shadow-sm card rounded-top rounded-4 h-100">
                                    <div class="p-0 card-body">
                                        <div class="mb-3 card-image">
                                            <img class="img-fluid rounded-2 w-100 justify-content-center"
                                                src="{{ asset('uploads/general/' . $item['image']) }}"
                                                alt="{{ $item['title'] }}">
                                        </div>

                                        <div class="card-content d-flex flex-grow-1">
                                            <div class="p-3">
                                                <h5 style="height: 48px;" class="mb-2 text-dark fw-bold">
                                                    {{ $item['title'] }}
                                                </h5>
                                                <span class="fw-bold">{{ number_format($item['price'], 2) }}</span>
                                                <span>ريال</span>
                                            </div>

                                            <div class="mt-auto d-grid">
                                                {{-- ✅ delete --}}
                                                <a class="py-3 btn btn-primary card-buttons rounded-0 rounded-top remove-from-cart-btn"
                                                    href="#" data-id="{{ $item['id'] }}">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.7837 3.55908H11.7721V2.73776C11.7721 2.37472 11.6279 2.02654 11.3712 1.76983C11.1145 1.51312 10.7663 1.3689 10.4033 1.3689H7.11801C6.75496 1.3689 6.40679 1.51312 6.15007 1.76983C5.89336 2.02654 5.74914 2.37472 5.74914 2.73776V3.55908H2.73764C2.66503 3.55908 2.5954 3.58792 2.54405 3.63927C2.49271 3.69061 2.46387 3.76024 2.46387 3.83285C2.46387 3.90546 2.49271 3.9751 2.54405 4.02644C2.5954 4.07778 2.66503 4.10663 2.73764 4.10663H3.55896V14.2362C3.55896 14.4541 3.64549 14.663 3.79952 14.817C3.95354 14.971 4.16245 15.0575 4.38028 15.0575H13.141C13.3588 15.0575 13.5677 14.971 13.7218 14.817C13.8758 14.663 13.9623 14.4541 13.9623 14.2362V4.10663H14.7837C14.8563 4.10663 14.9259 4.07778 14.9772 4.02644C15.0286 3.9751 15.0574 3.90546 15.0574 3.83285C15.0574 3.76024 15.0286 3.69061 14.9772 3.63927C14.9259 3.58792 14.8563 3.55908 14.7837 3.55908Z"
                                                            fill="#090909" />
                                                        <path
                                                            d="M14.7837 3.55908H11.7721V2.73776C11.7721 2.37472 11.6279 2.02654 11.3712 1.76983C11.1145 1.51312 10.7663 1.3689 10.4033 1.3689H7.11801C6.75496 1.3689 6.40679 1.51312 6.15007 1.76983C5.89336 2.02654 5.74914 2.37472 5.74914 2.73776V3.55908H2.73764C2.66503 3.55908 2.5954 3.58792 2.54405 3.63927C2.49271 3.69061 2.46387 3.76024 2.46387 3.83285C2.46387 3.90546 2.49271 3.9751 2.54405 4.02644C2.5954 4.07778 2.66503 4.10663 2.73764 4.10663H3.55896V14.2362C3.55896 14.4541 3.64549 14.663 3.79952 14.817C3.95354 14.971 4.16245 15.0575 4.38028 15.0575H13.141C13.3588 15.0575 13.5677 14.971 13.7218 14.817C13.8758 14.663 13.9623 14.4541 13.9623 14.2362V4.10663H14.7837C14.8563 4.10663 14.9259 4.07778 14.9772 4.02644C15.0286 3.9751 15.0574 3.90546 15.0574 3.83285C15.0574 3.76024 15.0286 3.69061 14.9772 3.63927C14.9259 3.58792 14.8563 3.55908 14.7837 3.55908Z"
                                                            fill="#FFFDFD" fill-opacity="0.95" />
                                                    </svg>
                                                    حذف
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="text-center alert alert-warning">
                                السلة فارغة حالياً
                            </div>
                        </div>
                    @endif

                </div> {{-- row products --}}

            </div> {{-- col-lg-8 --}}



            @php
                $total = 0;
                foreach ($cart['items'] as $item) {
                    $total += (float) $item['price'];
                }

                $vatRate = 0.14;

                $vatValue = $total * $vatRate;
                $subtotal = $total - $vatValue;
            @endphp



            {{-- ✅ Summary Column (4) --}}
            <div class="mb-5 col-12 col-lg-5">
                <div class="border-0 shadow card rounded-2">
                    <div class="p-4 card-body">
                        <h3 class="mb-4 text-center fw-bold">ملخص السلة</h3>

                        <hr class="border border-primary">


                        <div class="mb-5 d-flex justify-content-between">
                            <span class="fs-4">السعر قبل الضريبة</span>
                            <span class="fs-4">{{ number_format($subtotal, 2) }}
                                <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.9775 11.8496C12.8918 12.5429 12.8544 12.8436 12.5342 13.5195L7.61621 14.5352C7.72927 13.8044 7.88004 13.2404 8.125 12.9023L12.9775 11.8496ZM6.12695 7.06641L7.59668 6.74707V2.10352C8.14427 1.48883 8.4816 1.21316 9.14258 0.864258V6.41113L12.9775 5.5791C12.8918 6.27271 12.8545 6.57388 12.5342 7.25L9.14258 7.9668V9.52637L12.9775 8.71484C12.8918 9.40816 12.8544 9.70883 12.5342 10.3848L9.14258 11.085V11.0996L7.59668 11.4189V8.29297L6.12695 8.60352V10.5742L6.10059 10.5791C5.76261 11.1716 5.28681 11.884 4.82715 12.4521L0 13.3711C0.0432793 12.75 0.133241 12.4 0.414062 11.7744L4.58203 10.8701V8.92969L0.719727 9.74707C0.763011 9.12634 0.853109 8.77663 1.13379 8.15137L4.58203 7.40137V1.23926C5.12951 0.624713 5.46618 0.348818 6.12695 0V7.06641Z"
                                        fill="#3A3A3A" />
                                </svg>
                            </span>
                        </div>
                        {{-- <div class="mb-5 d-flex justify-content-between">
                            <span class="fs-4">قيمة الخصم (0.00%)</span>
                            <span class="fs-4">1080.90 <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.9775 11.8496C12.8918 12.5429 12.8544 12.8436 12.5342 13.5195L7.61621 14.5352C7.72927 13.8044 7.88004 13.2404 8.125 12.9023L12.9775 11.8496ZM6.12695 7.06641L7.59668 6.74707V2.10352C8.14427 1.48883 8.4816 1.21316 9.14258 0.864258V6.41113L12.9775 5.5791C12.8918 6.27271 12.8545 6.57388 12.5342 7.25L9.14258 7.9668V9.52637L12.9775 8.71484C12.8918 9.40816 12.8544 9.70883 12.5342 10.3848L9.14258 11.085V11.0996L7.59668 11.4189V8.29297L6.12695 8.60352V10.5742L6.10059 10.5791C5.76261 11.1716 5.28681 11.884 4.82715 12.4521L0 13.3711C0.0432793 12.75 0.133241 12.4 0.414062 11.7744L4.58203 10.8701V8.92969L0.719727 9.74707C0.763011 9.12634 0.853109 8.77663 1.13379 8.15137L4.58203 7.40137V1.23926C5.12951 0.624713 5.46618 0.348818 6.12695 0V7.06641Z"
                                        fill="#3A3A3A" />
                                </svg>
                            </span>
                        </div> --}}
                        {{-- <div class="mb-5 d-flex justify-content-between">
                            <span class="fs-4">السعر بعد الخصم</span>
                            <span class="fs-4">1080.90 <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.9775 11.8496C12.8918 12.5429 12.8544 12.8436 12.5342 13.5195L7.61621 14.5352C7.72927 13.8044 7.88004 13.2404 8.125 12.9023L12.9775 11.8496ZM6.12695 7.06641L7.59668 6.74707V2.10352C8.14427 1.48883 8.4816 1.21316 9.14258 0.864258V6.41113L12.9775 5.5791C12.8918 6.27271 12.8545 6.57388 12.5342 7.25L9.14258 7.9668V9.52637L12.9775 8.71484C12.8918 9.40816 12.8544 9.70883 12.5342 10.3848L9.14258 11.085V11.0996L7.59668 11.4189V8.29297L6.12695 8.60352V10.5742L6.10059 10.5791C5.76261 11.1716 5.28681 11.884 4.82715 12.4521L0 13.3711C0.0432793 12.75 0.133241 12.4 0.414062 11.7744L4.58203 10.8701V8.92969L0.719727 9.74707C0.763011 9.12634 0.853109 8.77663 1.13379 8.15137L4.58203 7.40137V1.23926C5.12951 0.624713 5.46618 0.348818 6.12695 0V7.06641Z"
                                        fill="#3A3A3A" />
                                </svg>
                            </span>
                        </div> --}}

                        <div class="mb-3 d-flex justify-content-between">
                            <span class="fs-4">قيمة الضريبة المضافة</span>
                            <span class="fs-4">{{ number_format($vatValue, 2) }}
                                <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.9775 11.8496C12.8918 12.5429 12.8544 12.8436 12.5342 13.5195L7.61621 14.5352C7.72927 13.8044 7.88004 13.2404 8.125 12.9023L12.9775 11.8496ZM6.12695 7.06641L7.59668 6.74707V2.10352C8.14427 1.48883 8.4816 1.21316 9.14258 0.864258V6.41113L12.9775 5.5791C12.8918 6.27271 12.8545 6.57388 12.5342 7.25L9.14258 7.9668V9.52637L12.9775 8.71484C12.8918 9.40816 12.8544 9.70883 12.5342 10.3848L9.14258 11.085V11.0996L7.59668 11.4189V8.29297L6.12695 8.60352V10.5742L6.10059 10.5791C5.76261 11.1716 5.28681 11.884 4.82715 12.4521L0 13.3711C0.0432793 12.75 0.133241 12.4 0.414062 11.7744L4.58203 10.8701V8.92969L0.719727 9.74707C0.763011 9.12634 0.853109 8.77663 1.13379 8.15137L4.58203 7.40137V1.23926C5.12951 0.624713 5.46618 0.348818 6.12695 0V7.06641Z"
                                        fill="#3A3A3A" />
                                </svg>
                            </span>
                        </div>


                        <div class="my-5 d-flex justify-content-between">
                            <span class="fw-bold fs-1">المجموع الكلي<br>
                                <p class="fs-5 text-secondary">(شامل قيمة الضريبة المضافة)</p>
                            </span>

                            <span class="mt-3 fw-bold fs-4"> {{ number_format($total, 2) }}
                                <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.9775 11.8496C12.8918 12.5429 12.8544 12.8436 12.5342 13.5195L7.61621 14.5352C7.72927 13.8044 7.88004 13.2404 8.125 12.9023L12.9775 11.8496ZM6.12695 7.06641L7.59668 6.74707V2.10352C8.14427 1.48883 8.4816 1.21316 9.14258 0.864258V6.41113L12.9775 5.5791C12.8918 6.27271 12.8545 6.57388 12.5342 7.25L9.14258 7.9668V9.52637L12.9775 8.71484C12.8918 9.40816 12.8544 9.70883 12.5342 10.3848L9.14258 11.085V11.0996L7.59668 11.4189V8.29297L6.12695 8.60352V10.5742L6.10059 10.5791C5.76261 11.1716 5.28681 11.884 4.82715 12.4521L0 13.3711C0.0432793 12.75 0.133241 12.4 0.414062 11.7744L4.58203 10.8701V8.92969L0.719727 9.74707C0.763011 9.12634 0.853109 8.77663 1.13379 8.15137L4.58203 7.40137V1.23926C5.12951 0.624713 5.46618 0.348818 6.12695 0V7.06641Z"
                                        fill="#3A3A3A" />
                                </svg>
                            </span>
                        </div>

                        <hr class="border border-primary">

                        <div class="my-4 form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                عند إتمام عملية الشراء فإنك تقر وتوافق على الالتزام <a class="text-primary"
                                    href="#">الشروط والأحكام</a>
                            </label>
                        </div>

                        <form action="{{ route('courses.checkout') }}" method="POST" class="p-0 m-0">
                            @csrf

                            <button type="submit" class="py-3 mx-auto btn btn-primary rounded-3">
                                إتمام عملية الدفع
                            </button>
                        </form>


                    </div>
                </div>

                <div>
                    <ul class="mt-5 text-center list-inline">
                        <li class="list-inline-item">
                            <img src="{{ asset('asset/website/assets/images/visa-pay.png') }}" alt="Visa">
                        </li>
                        <li class="list-inline-item">
                            <img class="my-2 my-sm-0" src="{{ asset('asset/website/assets/images/master-pay.png') }}"
                                alt="MasterCard">
                        </li>
                        <li class="list-inline-item">
                            <img class="my-2 my-sm-0" src="{{ asset('asset/website/assets/images/mada-pay.png') }}"
                                alt="Mada Pay">
                        </li>
                        <li class="list-inline-item">
                            <img class="my-2 my-sm-0" src="{{ asset('asset/website/assets/images/apple-pay.png') }}"
                                alt="Apple Pay">
                        </li>

                    </ul>
                </div>

            </div> {{-- col-lg-4 --}}

        </div> {{-- row main --}}
    </div>

@endsection




@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ✅ Toast Function
        function showToast(message, icon = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: message,
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true
            });
        }

        // ✅ Remove from cart
        document.querySelectorAll('.remove-from-cart-btn').forEach(btn => {

            btn.addEventListener('click', function(e) {
                e.preventDefault();

                let courseId = this.getAttribute('data-id');
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/cart/remove/${courseId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": csrf,
                            "Accept": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            // ✅ Update cart counter
                            let counter = document.querySelector('.cart-count');
                            if (counter) {
                                counter.innerText = data.count;
                            }

                            // ✅ Remove card from UI
                            let card = this.closest('.cart-item-card');
                            if (card) card.remove();

                            // ✅ Toast
                            showToast("تم الحذف من السلة ✅", "success");

                        } else {
                            showToast("حدث خطأ أثناء الحذف ❌", "error");
                        }

                    })
                    .catch(() => showToast("حدث خطأ غير متوقع ❌", "error"));
            });

        });
    </script>
@endpush
