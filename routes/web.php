<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\FundingController;

// 🌟 1. Trang chính - Welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 🌟 2. Xác thực tài khoản (Auth)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🌟 3. Trang Dashboard (Yêu cầu đăng nhập)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 🌟 4. Quản lý Hóa Đơn (Invoices)
    Route::prefix('invoices')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index'); // Danh sách hóa đơn
        Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create'); // Form đăng ký hóa đơn
        Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store'); // Xử lý đăng ký hóa đơn
        Route::get('/{id}', [InvoiceController::class, 'show'])->name('invoices.show'); // Xem chi tiết hóa đơn
        Route::get('/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit'); // Chỉnh sửa hóa đơn
        Route::put('/{id}', [InvoiceController::class, 'update'])->name('invoices.update'); // Cập nhật hóa đơn
        Route::delete('/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy'); // Xóa hóa đơn

        // 🌟 Tải hóa đơn
        Route::get('/{id}/download', [InvoiceController::class, 'download'])->name('invoices.download');

        // 🌟 Tính lãi suất tự động (mặc định 8%)
        Route::get('/{id}/interest', [InvoiceController::class, 'calculateInterest'])->name('invoices.interest');
    });

    // 🌟 5. Quản lý Nhà Cung Cấp (Suppliers)
    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index'); // Danh sách nhà cung cấp
        Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create'); // Form thêm nhà cung cấp
        Route::post('/', [SupplierController::class, 'store'])->name('suppliers.store'); // Xử lý thêm nhà cung cấp
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit'); // Sửa nhà cung cấp
        Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update'); // Cập nhật nhà cung cấp
        Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy'); // Xóa nhà cung cấp
    });

    // 🌟 6. Tài Trợ Hóa Đơn (Funding Requests)
    Route::prefix('funding')->group(function () {
        Route::get('/', [FundingController::class, 'index'])->name('funding.index'); // Danh sách yêu cầu tài trợ
        Route::post('/request', [FundingController::class, 'requestFunding'])->name('funding.request'); // Gửi yêu cầu tài trợ
        Route::get('/{id}/approve', [FundingController::class, 'approve'])->name('funding.approve'); // Duyệt tài trợ
        Route::get('/{id}/reject', [FundingController::class, 'reject'])->name('funding.reject'); // Từ chối tài trợ
    });
});
