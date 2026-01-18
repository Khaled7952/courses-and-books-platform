@extends('website.master')



@push('custom-css')
    <style>


    </style>
@endpush

@section('content')

    @include('website.home.book')
    @include('website.home.featured')
    @include('website.home.start')
    @include('website.home.products')
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {

        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            let courseId = this.getAttribute('data-id');
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf,
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: JSON.stringify({ course_id: courseId })
                })
                .then(res => res.json())
                .then(data => {

                    if (data.success) {

                        let counter = document.querySelector('.cart-count');
                        if (counter) counter.innerText = data.count;

                        // ✅ SweetAlert Success Toast
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message ?? '✅ تمت الإضافة إلى السلة',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: 'حدث خطأ أثناء إضافة المنتج',
                            confirmButtonText: 'تمام'
                        });

                    }

                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ غير متوقع',
                        text: 'حاول مرة أخرى',
                        confirmButtonText: 'تمام'
                    });
                });

        });

    });
</script>

@endpush
