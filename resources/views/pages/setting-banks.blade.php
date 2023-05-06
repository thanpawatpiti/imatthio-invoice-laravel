@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Setting'])
    <div class="container-fluid py-4">

        <form action="{{ route('setting.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" type="text" name="type" value="bank">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">เพิ่มข้อมูลธนาคาร</p>
                        <button class="btn btn-primary btn-sm ms-auto" type="submit">บันทึก</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ธนาคาร</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="bank" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">สาขา</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="branch" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ชื่อบัญชี</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="bank_name" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">เลขที่บัญชี</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="bank_number" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
@endsection
