@extends('dashboard.layout')

@section('content')
    <h1>تعديل نمط</h1>

    <form action="{{ route('modes.update', $mode) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">اسم النمط</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $mode->name) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="make_id" class="form-label">الماركة</label>
            <select class="form-select" name="make_id" id="make_id" required>
                <option value="">اختر ماركة</option>
                @foreach ($makes as $make)
                    <option value="{{ $make->id }}" {{ $mode->make_id == $make->id ? 'selected' : '' }}>
                        {{ $make->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">تحديث النمط</button>
    </form>
@endsection
