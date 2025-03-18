@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Chi Tiết Hóa Đơn</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nhà Cung Cấp:</th>
                    <td>{{ $invoice->supplier->name }}</td>
                </tr>
                <tr>
                    <th>Email Nhà Cung Cấp:</th>
                    <td>{{ $invoice->supplier->email }}</td>
                </tr>
                <tr>
                    <th>Người Mua:</th>
                    <td>{{ $invoice->buyer->name }}</td>
                </tr>
                <tr>
                    <th>Email Người Mua:</th>
                    <td>{{ $invoice->buyer->email }}</td>
                </tr>
                <tr>
                    <th>Số Tiền:</th>
                    <td>{{ number_format($invoice->amount, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>Lãi Suất (%):</th>
                    <td>{{ $invoice->interest_rate }}%</td>
                </tr>
                <tr>
                    <th>Ngày Đến Hạn:</th>
                    <td>{{ date('d/m/Y', strtotime($invoice->due_date)) }}</td>
                </tr>
                <tr>
                    <th>Lãi Suất Tính Được:</th>
                    <td>{{ number_format($interestAmount, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>File Hóa Đơn:</th>
                    <td>
                        @if ($invoice->file_path)
                            <a href="{{ asset('storage/' . $invoice->file_path) }}" target="_blank">Xem Hóa Đơn</a>
                        @else
                            Không có file
                        @endif
                    </td>
                </tr>
            </table>
            <div class="mt-3">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Quay Lại</a>
                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Chỉnh Sửa</a>
                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa hóa đơn này?')">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
