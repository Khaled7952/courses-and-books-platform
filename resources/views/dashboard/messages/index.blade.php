@extends('layouts.dashboard.app')
@section('title')
    Incoming Messages
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">

                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a>{{ __('dashboard.incoming_messages') }}</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">

                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="mb-0 list-inline">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                            <br>
                            <table class="table table-striped table-bordered complex-headers">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('dashboard.cunstomer_name') }}</th>
                                        <th scope="col">{{ __('dashboard.company_name') }}</th>
                                        <th scope="col">{{ __('dashboard.phone') }}</th>
                                        <th scope="col">{{ __('dashboard.email') }}</th>
                                        <th scope="col">{{ __('dashboard.date') }}</th>
                                        <th scope="col">{{ __('dashboard.message') }}</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($messages as $message)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->company_name }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->created_at }}</td>
                                            <td>{{ $message->message }}</td>
                                        </tr>


                                        {{-- delete form  --}}
                                        {{-- <form id="delete-form-{{ $role->id }}"
                                            action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}


                                    @empty
                                        <td colspan="4"> No Data</td>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- {{ $messages->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
