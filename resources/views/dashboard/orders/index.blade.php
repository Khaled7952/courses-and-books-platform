@extends('layouts.dashboard.app')

@section('title')
    الطلبات
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        {{-- Breadcrumb --}}
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.welcome') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">الطلبات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content-body">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">إدارة الطلبات</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">

                        {{-- SEARCH --}}
                        <form method="GET" action="{{ route('dashboard.orders.index') }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text"
                                           name="search"
                                           class="form-control"
                                           placeholder="ابحث برقم الطلب أو الاسم أو الجوال"
                                           value="{{ request('search') }}">
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary">بحث</button>
                                </div>
                            </div>
                        </form>

                        <br>

                        {{-- TABLE --}}
                        <table class="table text-center table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>رقم الطلب</th>
                                    <th>العميل</th>
                                    <th>الجوال</th>
                                    <th>الإجمالي</th>
                                    <th>الحالة</th>
                                    <th>عرض التفاصيل</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($orders as $order)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $order->order_code }}</td>

                                        <td>{{ $order->name }}</td>

                                        <td>{{ $order->phone }}</td>

                                        <td>{{ number_format($order->total_price,2) }} ر.س</td>

                                        <td>
                                            <span class="badge
                                            {{ $order->status=='paid'?'badge-success':($order->status=='failed'?'badge-danger':'badge-warning') }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <td>
                                            <button class="btn btn-info btn-sm show-order"
                                                    data-id="{{ $order->id }}">
                                                عرض
                                            </button>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7">لا توجد بيانات</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{-- PAGINATION --}}
                        <div class="mt-3">
                            {{ $orders->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



{{-- ================= MODAL ================= --}}
<div class="modal fade" id="orderModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="p-2 modal-content">

        <div class="modal-header">
            <h5 class="modal-title">تفاصيل الطلب</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div id="orderInfo"></div>

            <hr>

            <table class="table text-center table-bordered">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الحالة</th>
                        <th>تغيير الحالة</th>
                    </tr>
                </thead>

                <tbody id="itemsTable"></tbody>
            </table>

        </div>

    </div>
  </div>
</div>



<script>
document.querySelectorAll('.show-order').forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.getAttribute('data-id');

        fetch(`/dashboard/orders/${id}`,{
            headers:{ 'Accept':'application/json' }
        })
        .then(res=>res.json())
        .then(data=>{

            let order = data.order;
            let items = data.items;

            document.getElementById('orderInfo').innerHTML = `
                <strong>رقم الطلب:</strong> ${order.order_code} <br>
                <strong>العميل:</strong> ${order.name} <br>
                <strong>الجوال:</strong> ${order.phone} <br>
                <strong>الإجمالي:</strong> ${order.total_price} ر.س
            `;

            let rows = '';

            items.forEach(item=>{
                rows += `
                    <tr>
                        <td>${item.item_name}</td>
                        <td>${item.price} ر.س</td>

                        <td>
                            <span id="status-${item.id}"
                                class="badge ${item.status=='completed' ? 'badge-success' : 'badge-danger'}">
                                ${item.status}
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-warning btn-sm toggle-item"
                                data-id="${item.id}">
                                تبديل الحالة
                            </button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById('itemsTable').innerHTML = rows;

            new bootstrap.Modal(document.getElementById('orderModal')).show();

            bindToggleButtons();
        })
        .catch(()=> alert('خطأ في جلب البيانات'));
    });

});



function bindToggleButtons(){

    document.querySelectorAll('.toggle-item').forEach(btn=>{

        btn.addEventListener('click', function(){

            let id = this.getAttribute('data-id');

            fetch(`/dashboard/orders/items/${id}/toggle`,{
                method:'PATCH',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    'Accept':'application/json'
                }
            })
            .then(res=>res.json())
            .then(data=>{

                let badge = document.getElementById('status-'+id);

                if(data.status === 'completed'){
                    badge.classList.remove('badge-danger');
                    badge.classList.add('badge-success');
                }else{
                    badge.classList.remove('badge-success');
                    badge.classList.add('badge-danger');
                }

                badge.innerText = data.status;

            })
            .catch(()=> alert('حدث خطأ!'));

        });

    });

}
</script>

@endsection
