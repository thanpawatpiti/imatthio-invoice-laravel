@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Setting'])
    <div class="container-fluid py-4">

        <form action="{{ route('setting.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" type="text" name="type" value="header">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">เพิ่มข้อมูลส่วนหัว</p>
                        <button class="btn btn-primary btn-sm ms-auto" type="submit">บันทึก</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ส่วนหัว</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="name" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">เลขที่เสียภาษี</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="tax_id" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ที่อยู่</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="address" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">เบอร์โทร</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="phone" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">อีเมลล์</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="email" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">เว็บไซต์</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="website" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">โลโก้</label>
                                <input class="form-control" type="file" value="" accept="image/*" name="image"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
@endsection
