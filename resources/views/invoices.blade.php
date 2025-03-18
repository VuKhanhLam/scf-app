<!DOCTYPE html>
<html>
<head>
    <title>Danh Sách Hóa Đơn</title>
</head>
<body>
    <h1>Hóa Đơn Cần Thanh Toán</h1>
    @foreach($invoices as $invoice)
        <p>Hóa đơn #{{ $invoice->id }} - Số tiền: {{ $invoice->amount }}</p>
    @endforeach
</body>
</html>
