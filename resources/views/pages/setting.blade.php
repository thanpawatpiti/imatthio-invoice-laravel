@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Setting'])
    <div class="container-fluid py-4">

        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-lg-6 col-md-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center"
                                    data-bs-toggle="tab" href="#header-tabs" role="tab" aria-selected="true"
                                    tabindex="-1">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">ส่วนหัว</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    data-bs-toggle="tab" href="#bank-tabs" role="tab" aria-selected="false"
                                    tabindex="-1">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">ธนาคาร</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    data-bs-toggle="tab" href="#receipt-tabs" role="tab" aria-selected="false">
                                    <i class="ni ni-archive-2"></i>
                                    <span class="ms-2">ผู้รับ</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    data-bs-toggle="tab" href="#derector-tabs" role="tab" aria-selected="false">
                                    <i class="ni ni-circle-08"></i>
                                    <span class="ms-2">นำส่ง</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-content">
            {{-- Header --}}
            <div class="tab-pane fade show active" id="header-tabs" role="tabpanel">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">ส่วนหัว <a href="{{ route('setting.create', ['type' => 'headers']) }}"><i class="ni ni-fat-add text-primary"></i></a></h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($headers as $header)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $header->name }} @if($header->is_active) <span class="text-success ms-sm-2 font-weight-bold">[Active]</span> @endif</h6>
                                        <span class="mb-2 text-xs">{{ $header->tax_id }}</span>
                                        <span class="mb-2 text-xs">{{ $header->address }}</span>
                                        <span class="mb-2 text-xs">{{ $header->phone }}</span>
                                        <span class="mb-2 text-xs">{{ $header->email }}</span>
                                        <span class="mb-2 text-xs">{{ $header->website }}</span>
                                    </div>
                                    {{-- <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div> --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Bank --}}
            <div class="tab-pane fade show" id="bank-tabs" role="tabpanel">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">ธนาคาร <a href="{{ route('setting.create', ['type' => 'banks']) }}"><i class="ni ni-fat-add text-primary"></i></a></h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($banks as $bank)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $bank->bank }} @if($bank->is_active) <span class="text-success ms-sm-2 font-weight-bold">[Active]</span> @endif</h6>
                                        <span class="mb-2 text-xs">{{ $bank->branch }}</span>
                                        <span class="mb-2 text-xs">{{ $bank->bank_name }}</span>
                                        <span class="mb-2 text-xs">{{ $bank->bank_number }}</span>
                                    </div>
                                    {{-- <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div> --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Receipt --}}
            <div class="tab-pane fade show" id="receipt-tabs" role="tabpanel">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">ผู้รับ <a href="{{ route('setting.create', ['type' => 'receipts']) }}"><i class="ni ni-fat-add text-primary"></i></a></h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($receipts as $receipt)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $receipt->name }} @if($receipt->is_active) <span class="text-success ms-sm-2 font-weight-bold">[Active]</span> @endif</h6>
                                        <span class="mb-2 text-xs">{{ $receipt->tax_id }}</span>
                                        <span class="mb-2 text-xs">{{ $receipt->address }}</span>
                                    </div>
                                    {{-- <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div> --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Derector --}}
            <div class="tab-pane fade show" id="derector-tabs" role="tabpanel">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">นำส่ง <a href="{{ route('setting.create', ['type' => 'directors']) }}"><i class="ni ni-fat-add text-primary"></i></a></h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($directors as $director)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $director->name }} {{ $director->surname }}@if($director->is_active) <span class="text-success ms-sm-2 font-weight-bold">[Active]</span> @endif</h6>
                                        <span class="mb-2 text-xs">{{ $director->position }}</span>
                                    </div>
                                    {{-- <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div> --}}
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
