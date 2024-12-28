@extends('dashboard.layout')

@section('title', 'Add Admin')

@section('content')
    <h2>Add Admin</h2>

    <!-- عرض الرسائل الخطأ في النموذج -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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

        {{-- <div class="mb-3">
            <label for="is_admin" class="form-label">Is Admin</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin">
                <label class="form-check-label" for="is_admin">Check if Admin</label>
            </div>
        </div> --}}

        <button type="submit" class="btn btn-primary">Create Admin</button>
    </form>
@endsection
