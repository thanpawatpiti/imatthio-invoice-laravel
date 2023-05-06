@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing'])
    <div class="container-fluid py-4">

        <form action="{{ route('billing.store') }}" enctype="multipart/form-data" method="POST" id="form-create">
            @csrf
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">เพิ่มใบบิล</p>
                        <a class="btn btn-primary btn-sm ms-auto" onclick="confirmSave();" href="#">บันทึก</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">เลขที่ใบบิล</label>
                                <input class="form-control" type="text" value="" onfocus="focused(this)"
                                    name="invoice_number" onfocusout="defocused(this)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">วันที่</label>
                                <input class="form-control" type="date" value="" onfocus="focused(this)"
                                    name="invoice_date" onfocusout="defocused(this)" required>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ส่วนหัว</label>
                                <select class="form-control" name="config_headers_id" required>
                                    <option value="">เลือกส่วนหัว</option>
                                    @foreach ($headers as $config_header)
                                        <option value="{{ $config_header->id }}">{{ $config_header->name }}
                                            [{{ $config_header->tax_id }}] {{ $config_header->address }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ผู้รับ</label>
                                <select class="form-control" name="recepts_id" required>
                                    <option value="">เลือกผู้รับ</option>
                                    @foreach ($receipts as $recepts_id)
                                        <option value="{{ $recepts_id->id }}">{{ $recepts_id->name }}
                                            {{ $recepts_id->address }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ธนาคาร</label>
                                <select class="form-control" name="config_banks_id" required>
                                    <option value="">เลือกธนาคาร</option>
                                    @foreach ($banks as $banks_id)
                                        <option value="{{ $banks_id->id }}">{{ $banks_id->bank }} [{{ $banks_id->branch }}]
                                            {{ $banks_id->bank_number }}-{{ $banks_id->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">นำส่งโดย</label>
                                <select class="form-control" name="directors_id" required>
                                    <option value="">เลือกนำส่งโดย</option>
                                    @foreach ($directors as $deliverys_id)
                                        <option value="{{ $deliverys_id->id }}">{{ $deliverys_id->name }}
                                            {{ $deliverys_id->surname }} {{ $deliverys_id->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ส่วนลด(เปอร์เซ็น)</label>
                                <input class="form-control" type="number" value="" name="discount" placeholder="10"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header pb-0">
                                    <h6>เพิ่มรายละเอียด <i class="ni ni-fat-add text-primary" onclick="addRow();"></i></h6>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" width="100%" id="table-descriptions">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="65%">
                                                        รายละเอียด</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" width="10%">
                                                        Plant</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" width="10%">
                                                        จำนวน</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="10%">
                                                        ราคาต่อหน่วย</th>
                                                    <th class="text-secondary opacity-7" width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- @include('layouts.footers.auth.footer') --}}
    </div>
@endsection

@push('js')
    <script>
        function addRow() {
            var table = document.getElementById("table-descriptions");
            var row = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell();
            var cell5 = row.insertCell();
            cell1.innerHTML = '<input class="form-control" type="text" name="descriptions[]" required>';
            cell2.innerHTML = '<input class="form-control" type="text" name="plants[]" required>';
            cell3.innerHTML = '<input class="form-control" type="number" name="amounts[]" required>';
            cell4.innerHTML = '<input class="form-control" type="number" name="prices[]" required>';
            cell5.innerHTML = '<i class="ni ni-fat-remove text-danger" onclick="removeRow(this);"></i>';
        }

        function removeRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("table-descriptions").deleteRow(i);
        }

        function confirmSave() {
            Swal.fire({
                title: 'คุณต้องการบันทึกข้อมูลหรือไม่?',
                text: "หากยืนยันแล้วจะไม่สามารถแก้ไขข้อมูลได้อีก!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#858796',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // table descriptions not empty and validate
                    if (document.getElementById("table-descriptions").rows.length > 1) {
                        // validate form required before submit
                        if (document.getElementById("form-create").checkValidity()) {
                            document.getElementById("form-create").submit();
                        } else {
                            Swal.fire({
                                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                                icon: 'warning',
                                confirmButtonColor: '#4e73df',
                                confirmButtonText: 'ตกลง'
                            })
                        }
                    } else {
                        Swal.fire({
                            title: 'กรุณาเพิ่มรายละเอียดอย่างน้อย 1 รายการ',
                            icon: 'warning',
                            confirmButtonColor: '#4e73df',
                            confirmButtonText: 'ตกลง'
                        })
                    }
                }
            })
        }
    </script>
@endpush
