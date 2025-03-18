@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Bảng Điều Khiển Tài Trợ Chuỗi Cung Ứng</h2>

    <!-- Thống kê nhanh -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Hóa Đơn Đã Xác Nhận</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $confirmedInvoices ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Hóa Đơn Chờ Xét Duyệt</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $pendingInvoices ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Hóa Đơn Bị Từ Chối</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $rejectedInvoices ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Nút tải lên hóa đơn -->
    <div class="text-end mb-3">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">+ Tải Lên Hóa Đơn</a>
    </div>

    <!-- Danh sách hóa đơn -->
    <div class="card">
        <div class="card-header bg-primary text-white">Danh Sách Hóa Đơn</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nhà Cung Cấp</th>
                        <th>Người Mua</th>
                        <th>Số Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Tạo</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->supplier->name }}</td>
                        <td>{{ $invoice->buyer->name }}</td>
                        <td>{{ number_format($invoice->amount, 0, ',', '.') }} VND</td>
                        <td>
                            @if ($invoice->status == 'pending')
                                <span class="badge bg-warning">Chờ Duyệt</span>
                            @elseif ($invoice->status == 'approved')
                                <span class="badge bg-success">Đã Duyệt</span>
                            @else
                                <span class="badge bg-danger">Bị Từ Chối</span>
                            @endif
                        </td>
                        <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-info">Xem</a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
