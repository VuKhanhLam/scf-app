@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách hóa đơn</h2>
    <a href="{{ route('invoice.create') }}" class="btn btn-success mb-3">Đăng ký xét duyệt hóa đơn</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nhà cung cấp</th>
                <th>Người mua</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Hóa đơn</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->supplier->name }}</td>
                <td>{{ $invoice->buyer->name }}</td>
                <td>{{ number_format($invoice->amount, 2) }} VND</td>
                <td>{{ ucfirst($invoice->status) }}</td>
                <td>
                    @if($invoice->invoice_file)
                        <a href="{{ asset('storage/' . $invoice->invoice_file) }}" target="_blank">Xem hóa đơn</a>
                    @endif
                </td>
                <td>
                    @if($invoice->status == 'pending')
                        <form action="{{ route('invoice.approve', $invoice->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </form>
                    @else
                        Đã xử lý
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
