@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Đăng Ký Xét Duyệt Hóa Đơn</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Chọn Nhà Cung Cấp:</label>
            <select name="supplier_id" id="supplier_id" class="form-control" required>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Số Tiền (VNĐ):</label>
            <input type="number" name="amount" id="amount" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Ngày Đến Hạn:</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Gửi Yêu Cầu</button>
    </form>
</div>
@endsection
