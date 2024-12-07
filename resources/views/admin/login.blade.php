<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSkt60eINwvrpNh0E263XmFcJlSAwiGgFAW/dAiS6JX" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        {{-- @if ($errors->has())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif --}}
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="{{ route('admin.login') }}" class="border p-4 rounded shadow-sm">
                    @csrf
                    <h2 class="text-center mb-4">تسجيل دخول المسؤول</h2>

                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="البريد الإلكتروني" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="كلمة المرور" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">دخول</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12CpXzOloRWYqjEdkuF8PjmO60pFHG8KsAN3ymf4kPz9F+g" crossorigin="anonymous"></script>

</body>

</html>
