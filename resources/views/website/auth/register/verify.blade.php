@extends('website.master')



@push('custom-css')

@endpush

@section('content')

<form action="{{ route('customer.verify.check') }}" method="POST"
style="margin: 150px 100px">

    @csrf

    {{-- OTP --}}
    <div class="mb-3">
        <label>أدخل كود التحقق</label>

        <input
            type="text"
            name="otp"
            class="form-control"
            inputmode="numeric"
            pattern="[0-9]*"
            maxlength="5"
            minlength="5"
            required
        >
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary w-100">
        تأكيد الكود
    </button>

</form>


@endsection

@push('scripts')

@endpush
