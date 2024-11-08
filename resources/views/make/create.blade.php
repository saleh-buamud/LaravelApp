@extends('dashboard.layout')

@section('content')
    <h1>إضافة ماركة جديدة</h1>

    <form action="{{ route('makes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">اسم الماركة</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary">إضافة الماركة</button>
    </form>
@endsection
