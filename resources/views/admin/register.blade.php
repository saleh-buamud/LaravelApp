<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج التسجيل</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSkt60eINwvrpNh0E263XmFcJlSAwiGgFAW/dAiS6JX" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <input type="password" name="password" placeholder="Password" required>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}"
                        required>
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <button type="submit">Register</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12CpXzOloRWYqjEdkuF8PjmO60pFHG8KsAN3ymf4kPz9F+g" crossorigin="anonymous"></script>

</body>

</html>
