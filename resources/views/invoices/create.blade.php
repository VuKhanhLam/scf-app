@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Đăng Ký Xét Duyệt Hóa Đơn</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nhà Cung Cấp -->
                <div class="form-group">
                    <label for="supplier_name">Nhà Cung Cấp</label>
                    <input type="text" name="supplier_name" class="form-control" required placeholder="Nhập tên nhà cung cấp">
                </div>

                <div class="form-group">
                    <label for="supplier_email">Email Nhà Cung Cấp</label>
                    <input type="email" name="supplier_email" class="form-control" required placeholder="Nhập email nhà cung cấp">
                </div>

                <!-- Người Mua -->
                <div class="form-group">
                    <label for="buyer_name">Người Mua</label>
                    <input type="text" name="buyer_name" class="form-control" required placeholder="Nhập tên người mua">
                </div>

                <div class="form-group">
                    <label for="buyer_email">Email Người Mua</label>
                    <input type="email" name="buyer_email" class="form-control" required placeholder="Nhập email người mua">
                </div>

                <!-- Số Tiền -->
                <div class="form-group">
                    <label for="amount">Số Tiền (VND)</label>
                    <input type="number" name="amount" class="form-control" required min="1000" placeholder="Nhập số tiền">
                </div>

                <!-- Ngày Đến Hạn -->
                <div class="form-group">
                    <label for="due_date">Ngày Đến Hạn</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <!-- Lãi Suất (Mặc định 8%) -->
                <div class="form-group">
                    <label for="interest_rate">Lãi Suất (%)</label>
                    <input type="number" name="interest_rate" class="form-control" value="8" readonly>
                </div>

                <!-- File Hóa Đơn -->
                <div class="form-group">
                    <label for="invoice_file">Tải Lên Hóa Đơn</label>
                    <input type="file" name="invoice_file" class="form-control-file" required accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <!-- Nút Gửi -->
                <button type="submit" class="btn btn-primary mt-3">Gửi Xét Duyệt</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
