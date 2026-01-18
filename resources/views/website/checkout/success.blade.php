@extends('website.master')

@push('custom-css')
<style>
    .invoice-wrap{
        max-width: 820px;
        margin: 60px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 40px rgba(0,0,0,.08);
        overflow: hidden;
    }
    .invoice-head{
        padding: 28px 30px;
        background: linear-gradient(135deg, #e8fff1, #ffffff);
        border-bottom: 1px solid #f1f1f1;
        text-align: center;
    }
    .success-icon{
        width: 78px;
        height: 78px;
        border-radius: 50%;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e9fff0;
        border: 2px solid #19c37d;
    }
    .invoice-body{
        padding: 26px 30px 30px;
    }
    .info-grid{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 18px;
        margin-bottom: 18px;
    }
    .info-item{
        background:#fafafa;
        border:1px solid #f1f1f1;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 15px;
    }
    .info-item b{ color:#111; }
    .table{
        margin-top: 10px;
        border-radius: 12px;
        overflow: hidden;
    }
    .table th{
        background:#f8f9fa;
        font-weight: 700;
        border: 0 !important;
    }
    .table td{
        vertical-align: middle;
    }
    .invoice-footer{
        display:flex;
        gap: 12px;
        justify-content: center;
        padding-top: 18px;
    }
</style>
@endpush

@section('content')
@php

    $order = $order ?? null;
    $customer = $order?->customer;
    $item = $order?->items?->first();
@endphp

<div class="container">
    <div class="invoice-wrap">

        <div class="invoice-head">
            <div class="success-icon">
                <i class="fa-solid fa-check" style="font-size:34px;color:#19c37d;"></i>
            </div>
            <h2 class="mb-1 fw-bold" style="color:#19c37d;">تم الدفع بنجاح</h2>
            <p class="mb-0 text-muted">شكراً لك، تم تأكيد عملية الدفع وإصدار الفاتورة.</p>
        </div>

        <div class="invoice-body">
            <div class="info-grid">
                <div class="info-item"><b>رقم الطلب:</b> {{ $order?->order_code }}</div>
                <div class="info-item"><b>حالة الطلب:</b> <span class="badge bg-success">مدفوع</span></div>

                <div class="info-item"><b>اسم العميل:</b> {{ $customer?->name ?? '-' }}</div>
                <div class="info-item"><b>رقم الجوال:</b> {{ $customer?->mobile ?? '-' }}</div>

                <div class="info-item"><b>التاريخ:</b> {{ $order?->updated_at?->format('Y-m-d h:i A') }}</div>
                <div class="info-item"><b>طريقة الدفع:</b> Paymob</div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>المنتج</th>
                            <th class="text-center">النوع</th>
                            <th class="text-end">السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">{{ $item?->item_name ?? 'Book' }}</td>
                            <td class="text-center">كتاب</td>
                            <td class="text-end fw-bold">{{ number_format((float)$order?->total_price, 2) }} SAR</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="border-top:1px solid #f1f1f1;">
                            <td colspan="2" class="text-end fw-bold">الإجمالي</td>
                            <td class="text-end fw-bold">{{ number_format((float)$order?->total_price, 2) }} SAR</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="invoice-footer">
                <a href="{{ route('profile') }}" class="px-4 btn btn-primary">
                    الانتقال للصفحة الشخصية للاطلاع على الكتاب
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
