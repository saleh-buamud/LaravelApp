@extends('dashboard.layout')

@section('content')
    <h1>تعديل ماركة</h1>

    <form action="{{ route('dashboard.makes.update', $make) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">اسم الماركة</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $make->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">تحديث الماركة</button>
    </form>
@endsection
