@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">ใบบิล</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-outline-primary btn-sm mb-0" href="{{ route('billing.create') }}">สร้างบิล</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <ul class="list-group">
                            @foreach ($bills as $bill)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $bill->invoice_number }}</h6>
                                        <span class="text-xs">{{ $bill->receipts->name }} {{ $bill->receipts->address }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        {{ simpleDateFormat($bill->invoice_date) }}
                                        <a class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" href="{{ route('billing.pdf', ['id' => $bill->id, 'type' => 'invoice']) }}" target="_blank"><i
                                                class="fas fa-file-pdf text-lg me-1"></i> PDF</a>
                                        <a class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" href="{{ route('billing.pdf', ['id' => $bill->id, 'type' => 'copy']) }}" target="_blank"><i
                                                class="fas fa-file-pdf text-lg me-1"></i> PDF(copy)</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
@endsection
