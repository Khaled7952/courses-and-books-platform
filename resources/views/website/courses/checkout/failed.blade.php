@extends('website.master')

@push('custom-css')
    <style>
        .checkout-failed-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkout-failed-card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border-radius: 14px;
            padding: 40px 28px;
            text-align: center;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }

        .failed-icon {
            width: 110px;
            height: 110px;
            margin: 0 auto 18px;
            border-radius: 50%;
            border: 4px solid #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .failed-icon span {
            font-size: 58px;
            font-weight: 900;
            color: #dc3545;
            line-height: 1;
        }

        .failed-title {
            font-size: 26px;
            font-weight: 800;
            color: #111;
            margin-bottom: 10px;
        }

        .failed-desc {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 28px;
            line-height: 1.9;
        }

        .failed-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .failed-btn {
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: 700;
            border: 0;
        }

        .failed-btn-outline {
            background: transparent;
            border: 2px solid #111;
            color: #111;
        }
    </style>
@endpush

@section('content')
    <div class="checkout-failed-wrapper">
        <div class="checkout-failed-card">

            <div class="failed-icon">
                <span>×</span>
            </div>

            <div class="failed-title">فشل إتمام الدفع</div>

            <div class="failed-desc">
                لم تكتمل عملية الدفع بنجاح.
                <br>
                من فضلك تأكد من بيانات البطاقة وحاول مرة أخرى.
            </div>

            <div class="failed-actions">
                <a href="{{ route('cart.index') }}" class="btn btn-primary failed-btn">
                    الرجوع للسلة
                </a>

                <a href="{{ route('courses.index') }}" class="btn failed-btn failed-btn-outline">
                    تصفح الكورسات
                </a>
            </div>

        </div>
    </div>
@endsection
