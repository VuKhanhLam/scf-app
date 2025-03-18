<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Trợ Chuỗi Cung Ứng - SCF Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">SCF Platform</a>
            <div>
                @if(auth()->check())
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Vào Trang quản lý hóa đơn
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Đăng ký
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative w-full h-[500px] bg-cover bg-center flex items-center" style="background-image: url('https://techcombank.com/assets/images/homepage-banner.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container mx-auto text-center text-white relative z-10">
            <h1 class="text-4xl font-bold">Giải Pháp Tài Trợ Chuỗi Cung Ứng</h1>
            <p class="mt-4 text-lg">Tối ưu dòng tiền, giảm thiểu rủi ro tài chính, hỗ trợ phát triển doanh nghiệp.</p>
            @if(auth()->check())
                <a href="{{ route('dashboard') }}" class="mt-6 inline-block bg-green-600 px-6 py-3 text-lg font-semibold rounded-lg hover:bg-green-700 transition">
                    Vào Trang quản lý hóa đơn
                </a>
            @else
                <a href="{{ route('register') }}" class="mt-6 inline-block bg-red-600 px-6 py-3 text-lg font-semibold rounded-lg hover:bg-red-700 transition">
                    Bắt đầu ngay
                </a>
            @endif
        </div>
    </section>

    <!-- Giới thiệu SCF -->
    <section class="container mx-auto px-6 py-16 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Tại sao chọn Tài Trợ Chuỗi Cung Ứng?</h2>
        <p class="text-gray-600 mt-4">Giải pháp giúp doanh nghiệp tối ưu hóa dòng tiền, giảm chi phí tài chính và xây dựng mối quan hệ vững chắc với đối tác.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="https://techcombank.com/assets/icons/money.svg" class="w-16 mx-auto">
                <h3 class="mt-4 text-xl font-semibold">Giảm áp lực tài chính</h3>
                <p class="mt-2 text-gray-600">Nhận thanh toán sớm mà không ảnh hưởng đến quan hệ với người mua.</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="https://techcombank.com/assets/icons/security.svg" class="w-16 mx-auto">
                <h3 class="mt-4 text-xl font-semibold">Giảm thiểu rủi ro</h3>
                <p class="mt-2 text-gray-600">Đảm bảo dòng tiền ổn định, tránh nguy cơ chậm thanh toán.</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <img src="https://techcombank.com/assets/icons/growth.svg" class="w-16 mx-auto">
                <h3 class="mt-4 text-xl font-semibold">Tăng trưởng bền vững</h3>
                <p class="mt-2 text-gray-600">Tối ưu vốn lưu động và mở rộng kinh doanh hiệu quả.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-6">
        <p>&copy; 2025 SCF Platform - Tài Trợ Chuỗi Cung Ứng</p>
    </footer>

</body>
</html>
