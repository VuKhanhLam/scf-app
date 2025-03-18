@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa Hóa đơn</h2>
    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Số tiền</label>
            <input type="number" name="amount" class="form-control" value="{{ $invoice->amount }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày đến hạn</label>
            <input type="date" name="due_date" class="form-control" value="{{ $invoice->due_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
