@extends('layouts.dashboard.app')

@section('title')
    العملاء
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
                                <li class="breadcrumb-item active">العملاء</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">إدارة العملاء</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                            {{-- SEARCH --}}
                            <form method="GET" action="{{ route('dashboard.customers.index') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="ابحث باسم العميل أو رقم الجوال" value="{{ request('search') }}">
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
                                        <th>الاسم</th>
                                        <th>رقم الجوال</th>
                                        <th>مفعل ؟</th>
                                        <th>تفعيل / تعطيل</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($customers as $customer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $customer->name }}</td>

                                            <td>{{ $customer->mobile }}</td>

                                            {{-- STATUS --}}
                                            <td>
                                                <span id="status-{{ $customer->id }}"
                                                    class="badge {{ $customer->is_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $customer->is_active ? 'نشط' : 'غير نشط' }}
                                                </span>
                                            </td>


                                            {{-- TOGGLE STATUS --}}
                                            <td>
                                                <input type="checkbox" class="status-toggle" data-id="{{ $customer->id }}"
                                                    {{ $customer->is_active ? 'checked' : '' }}>
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="5">لا توجد بيانات</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>

                            {{-- PAGINATION --}}
                            <div class="mt-3">
                                {{ $customers->links() }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- AJAX Toggle --}}

    <script>
document.querySelectorAll('.status-toggle').forEach((el)=>{

    el.addEventListener('change', function(){

        let id = this.getAttribute('data-id');

        fetch(`/dashboard/customers/${id}/toggle`,{
            method:'PATCH',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'Accept':'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {

            let badge = document.getElementById('status-'+id);

            if(data.is_active){
                badge.classList.remove('badge-danger');
                badge.classList.add('badge-success');
                badge.innerText = 'نشط';
            }else{
                badge.classList.remove('badge-success');
                badge.classList.add('badge-danger');
                badge.innerText = 'غير نشط';
            }

        })
        .catch(()=> alert('حدث خطأ!'));

    });

});
</script>


@endsection
