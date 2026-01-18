@extends('website.master')



@push('custom-css')

@endpush

@section('content')

<form action="{{ route('customer.register.store') }}" method="POST"
style="margin: 150px 100px">

    @csrf

    {{-- Name --}}
    <div class="mb-3">
        <label>الاسم</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    {{-- Mobile --}}
    <div class="mb-3">
        <label>رقم الجوال</label>
        <input type="text" name="mobile" class="form-control" required>
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label>كلمة المرور</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    {{-- Terms --}}
    <div class="mb-3 form-check">
        <input type="checkbox" name="agree" value="1" class="form-check-input" id="agree" required>
        <label for="agree" class="form-check-label">
            أوافق على الشروط والأحكام
        </label>
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary w-100">
        تسجيل
    </button>

</form>

@endsection

@push('scripts')

@endpush
