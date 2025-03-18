<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Supplier;
use App\Models\Buyer;

class InvoiceController extends Controller
{
    /**
     * Hiển thị form tạo hóa đơn
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Lưu hóa đơn vào database
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_email' => 'required|email',
            'buyer_name' => 'required|string|max:255',
            'buyer_email' => 'required|email',
            'amount' => 'required|numeric|min:1000',
            'invoice_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'interest_rate' => 'required|numeric|min:0',
            'due_date' => 'required|date'
        ]);

        // Tìm hoặc tạo mới Nhà Cung Cấp
        $supplier = Supplier::firstOrCreate(
            ['name' => $request->supplier_name],
            ['email' => $request->supplier_email]
        );

        // Tìm hoặc tạo mới Người Mua
        $buyer = Buyer::firstOrCreate(
            ['name' => $request->buyer_name],
            ['email' => $request->buyer_email]
        );

        // Xử lý file tải lên
        if ($request->hasFile('invoice_file')) {
            $file = $request->file('invoice_file');
            $filePath = $file->store('invoices', 'public');
        }

        // Tạo hóa đơn mới
        $invoice = Invoice::create([
            'supplier_id' => $supplier->id,
            'buyer_id' => $buyer->id,
            'amount' => $request->amount,
            'file_path' => $filePath ?? null,
            'interest_rate' => $request->interest_rate,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('dashboard')->with('success', 'Hóa đơn đã được tạo thành công.');
    }

    /**
     * Hiển thị chi tiết hóa đơn
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        // Tính toán lãi suất
        $principal = $invoice->amount * 0.8; // 80% tài trợ
        $days = (strtotime($invoice->due_date) - strtotime(now())) / 86400;
        $interestAmount = $principal * ($invoice->interest_rate / 100 / 365) * $days;

        return view('invoices.show', compact('invoice', 'interestAmount'));
    }

    /**
     * Hiển thị form chỉnh sửa hóa đơn
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Cập nhật hóa đơn
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Validate dữ liệu đầu vào
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'interest_rate' => 'required|numeric|min:0',
            'due_date' => 'required|date'
        ]);

        $invoice->update([
            'amount' => $request->amount,
            'interest_rate' => $request->interest_rate,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('dashboard')->with('success', 'Hóa đơn đã được cập nhật.');
    }

    /**
     * Xóa hóa đơn
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('dashboard')->with('success', 'Hóa đơn đã được xóa.');
    }
}
