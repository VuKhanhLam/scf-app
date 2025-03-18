<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - SCF Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Đăng Ký</h2>
        <p class="text-center text-gray-500 mb-6">Tạo tài khoản mới để sử dụng hệ thống</p>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Tên đầy đủ -->
            <div class="mb-4">
                <label class="block text-gray-600">Họ và Tên</label>
                <input type="text" name="name" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nhập họ và tên">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-600">Email</label>
                <input type="email" name="email" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nhập email của bạn">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mật khẩu -->
            <div class="mb-4">
                <label class="block text-gray-600">Mật khẩu</label>
                <input type="password" name="password" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nhập mật khẩu">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Xác nhận mật khẩu -->
            <div class="mb-4">
                <label class="block text-gray-600">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nhập lại mật khẩu">
            </div>

            <!-- Nút đăng ký -->
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">
                Đăng Ký
            </button>

            <!-- Đã có tài khoản -->
            <p class="text-center text-gray-600 mt-4">
                Đã có tài khoản? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Đăng nhập ngay</a>
            </p>
        </form>
    </div>

</body>
</html>
