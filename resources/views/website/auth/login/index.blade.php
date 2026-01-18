@extends('website.master')

@section('content')
    <div style="padding:150px 0">

        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-5">

                    <h4 class="mb-4 text-center">تسجيل الدخول</h4>
                    @if($errors->has('general'))
    <div class="text-center alert alert-danger">
        {{ $errors->first('general') }}
    </div>
@endif


                    <form action="{{ route('customer.login.store') }}" method="POST">
                        @csrf

                        {{-- Mobile / Username --}}
                        <div class="mb-3">
                            <label class="form-label">رقم الجوال</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}"
                                class="form-control @error('mobile') is-invalid @enderror" placeholder="مثال: 05xxxxxxxx">

                            @error('mobile')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">

                            <label class="form-check-label" for="remember">
                                تذكرني
                            </label>
                        </div>


                        {{-- Submit --}}
                        <div class="mt-3 mb-2 d-grid">
                            <button type="submit" class="btn btn-primary">
                                دخول
                            </button>
                        </div>

                        {{-- Reset Password --}}
                        <div class="text-center">
                            {{-- <a href="{{ route('customer.password.reset.show') }}">
                            هل نسيت كلمة المرور؟
                        </a> --}}
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
@endsection
