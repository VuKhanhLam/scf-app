<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Supplier;
use App\Models\Buyer;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Hiển thị bảng điều khiển
     */
    public function index()
    {
        // Lấy danh sách hóa đơn, phân trang 10 hóa đơn mỗi trang
        $invoices = Invoice::with(['supplier', 'buyer'])->orderBy('created_at', 'desc')->paginate(10);

        // Đếm số lượng hóa đơn theo trạng thái
        $confirmedInvoices = Invoice::where('status', 'approved')->count();
        $pendingInvoices = Invoice::where('status', 'pending')->count();
        $rejectedInvoices = Invoice::where('status', 'rejected')->count();

        // Trả về giao diện dashboard
        return view('dashboard', compact('invoices', 'confirmedInvoices', 'pendingInvoices', 'rejectedInvoices'));
    }

    /**
     * Hiển thị form tải lên hóa đơn
     */
    public function createInvoice()
    {
        $suppliers = Supplier::all();
        $buyers = Buyer::all();

        return view('invoices.create', compact('suppliers', 'buyers'));
    }

    /**
     * Xử lý tải lên hóa đơn mới
     */
    public function storeInvoice(Request $request)
{
    $request->validate([
        'supplier_id' => 'required',
        'buyer_id' => 'required|exists:buyers,id',
        'amount' => 'required|numeric|min:1000',
        'invoice_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Kiểm tra nếu nhà cung cấp là mới (có tiền tố "new_")
    if (str_starts_with($request->supplier_id, 'new_')) {
        $supplierName = substr($request->supplier_id, 4);
        $supplier = Supplier::create(['name' => $supplierName]);
        $supplierId = $supplier->id;
    } else {
        $supplierId = $request->supplier_id;
    }

    // Xử lý file tải lên
    if ($request->hasFile('invoice_file')) {
        $file = $request->file('invoice_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('invoices', $fileName, 'public');
    }

    // Tạo hóa đơn mới
    Invoice::create([
        'supplier_id' => $supplierId,
        'buyer_id' => $request->buyer_id,
        'amount' => $request->amount,
        'status' => 'pending',
        'invoice_file' => $filePath ?? null,
    ]);

    return redirect()->route('dashboard')->with('success', 'Hóa đơn đã được tải lên và chờ xét duyệt.');
}


    /**
     * Hiển thị chi tiết hóa đơn
     */
    public function showInvoice($id)
    {
        $invoice = Invoice::with(['supplier', 'buyer'])->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Xóa hóa đơn
     */
    public function destroyInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('dashboard')->with('success', 'Hóa đơn đã được xóa.');
    }
}
