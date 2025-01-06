@extends('dashboard.layout')

@section('title', 'Add Admin')

@section('content')
    <h2>Add Admin</h2>

    <!-- عرض رسائل الخطأ في النموذج -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- عرض رسالة النجاح إذا كانت موجودة -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- حقل can_create_users -->
        {{-- <div class="mb-3">
            <label for="can_create_users" class="form-label">Can Create Users</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="can_create_users" id="can_create_users">
                <label class="form-check-label" for="can_create_users">Check if the admin can create users</label>
            </div>
        </div> --}}

        <button type="submit" class="btn btn-primary">Create Admin</button>
    </form>
@endsection
