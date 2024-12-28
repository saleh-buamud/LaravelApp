<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>

    <!-- إضافة رابط Bootstrap 5 عبر CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
        }

        .register-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .register-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

    <!-- شكل النموذج داخل حاوية بووتستراب -->
    <div class="register-container">
        <h2 class="text-center">Admin Register</h2>

        <!-- نموذج التسجيل -->
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf

            <!-- اسم المستخدم -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    required>
            </div>

            <!-- البريد الإلكتروني -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <!-- كلمة المرور -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- تأكيد كلمة المرور -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <!-- زر التسجيل -->
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>
        </form>
    </div>

    <!-- إضافة مكتبات JavaScript الخاصة بـ Bootstrap عبر CDN (اختياري) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
