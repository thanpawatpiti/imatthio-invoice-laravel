<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }
    </style>
</head>

<body>
    @php
        $sum = 0;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 25%;"><strong><h2>{{ $bill->headers->name }}</h2></strong></td>
                        <td style="width: 50%; text-align: center;">
                            @if($bill->headers->logo)
                                <img src="{{ public_path('images/' . $bill->headers->logo) }}" alt="Logo" style="width: 100px; height: 100px;">
                            @endif
                        </td>
                        <td style="width: 25%; text-align: right;">สำเนา</td>
                    </tr>
                </table>
                <hr style="border: 1px solid black;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 100%;" colspan="2"><strong>{{ $bill->headers->address }}</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 50%;"><strong>โทรศัพท์ {{ $bill->headers->phone }}</strong></td>
                        <td style="width: 50%;"><strong>เวปไซต์ {{ $bill->headers->tax_id }}</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 50%;"><strong>เลขประจำตัวผู้เสียภาษี {{ $bill->headers->tax_id }}</strong></td>
                        <td style="width: 50%;"><strong>อีเมล {{ $bill->headers->email }}</strong></td>
                    </tr>
                </table>
                <br/>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 100%; text-align: center;" colspan="3" bgcolor="#B7B3B1"><strong>ใบเสร็จรับเงิน/ใบส่งของ</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;" rowspan="4"><strong>เรียน/Attention:</strong></td>
                        <td style="width: 55%;">{{ $bill->receipts->name }}</td>
                        <td style="width: 35%;"><strong>เลขที่ / No : </strong>{{ $bill->invoice_number }}</td>
                    </tr>
                    <tr>
                        <td style="width: 55%;">{{ $bill->receipts->address }}</td>
                        <td style="width: 35%;"><strong>วันที่ / Date : </strong>{{ simpleDateFormat($bill->invoice_date) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 55%;">เลขประจำตัวผู้เสียภาษี {{ $bill->receipts->tax_id }}</td>
                        <td style="width: 35%;"></td>
                    </tr>
                </table>
                <br/>
                ขอนำส่งสินค้า ดังรายละเอียด ดังนี้
                <br/>
                We are please to deliver you the following described here in at price, items and terms stated :
                <br/>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 5%; text-align: center;"><strong>ลำดับ</strong></td>
                        <td style="width: 45%; text-align: center;"><strong>รายการ</strong></td>
                        <td style="width: 10%; text-align: center;"><strong>จำนวน</strong></td>
                        <td style="width: 10%; text-align: center;"><strong>ราคา</strong></td>
                        <td style="width: 10%; text-align: center;"><strong>จำนวนเงิน</strong></td>
                    </tr>
                    @foreach($bill->descriptions as $key => $detail)
                        <tr>
                            <td style="width: 5%; text-align: center;">{{ $key + 1 }}</td>
                            <td style="width: 45%;">{{ $detail->description }}<br/><strong>Plant:{{ $detail->plant }}</strong></td>
                            <td style="width: 10%; text-align: center;">{{ $detail->amount }}</td>
                            <td style="width: 10%; text-align: center;">{{ number_format($detail->price, 2) }}</td>
                            <td style="width: 10%; text-align: center;">{{ number_format($detail->amount * $detail->price, 2) }}</td>
                        </tr>
                        @php
                            $sum += $detail->amount * $detail->price;
                        @endphp
                    @endforeach
                    <tr>
                        <td style="width: 5%; text-align: right;" colspan="4"><strong>Sub Total</strong></td>
                        <td style="width: 10%; text-align: center;">{{ number_format($sum, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 5%; text-align: right;" colspan="4"><strong>หักส่วนลด {{ $bill->discount }}%</strong></td>
                        <td style="width: 10%; text-align: center;">{{ number_format(($sum * $bill->discount) / 100, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; text-align: center;" colspan="3" bgcolor="#B7B3B1"><strong>{{ convertAmountToLetter($sum - ($sum * $bill->discount) / 100) }}</strong></td>
                        <td style="width: 5%; text-align: right;"><strong>Total Amount</strong></td>
                        <td style="width: 10%; text-align: center;">{{ number_format($sum - ($sum * $bill->discount) / 100, 2) }}</td>
                    </tr>
                </table>
                <br/>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%;"><strong><u>หมายเหตุ</u></strong></td>
                        <td style="width: 50%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">กรุณาโอนเงินเข้าบัญชี {{ $bill->banks->bank }}</td>
                        <td style="width: 50%; text-align: center;">({{ $bill->directors->name }} {{ $bill->directors->surname }})</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">สาขา {{ $bill->banks->branch }}</td>
                        <td style="width: 50%; text-align: center;">{{ $bill->directors->position }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">เลขที่บัญชี {{ $bill->banks->bank_number }}</td>
                        <td style="width: 50%; text-align: center;">ผู้นำส่ง</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">ชื่อบัญชี {{ $bill->banks->bank_name }}</td>
                        <td style="width: 50%; text-align: center;"></td>
                    </tr>
                </table>
                <br/>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%;"></td>
                        <td style="width: 50%; text-align: center;">
                            @if($bill->headers->logo)
                                <img src="{{ public_path('images/' . $bill->headers->logo) }}" alt="Logo" style="width: 80px; height: 80px;">
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
