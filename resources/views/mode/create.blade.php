@extends('dashboard.layout')

@section('content')
    <h1>إضافة موديل  جديد</h1>

    <form action="{{ route('dashboard.modes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">اسم موديل </label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="make_id" class="form-label">الماركة</label>
            <select class="form-select" name="make_id" id="make_id" required>
                <option value="">اختر ماركة</option>
                @foreach ($makes as $make)
                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">إضافة النمط</button>
    </form>
@endsection
