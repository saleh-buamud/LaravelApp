@extends('dashboard.layout')
@section('edit')
    <h2 style="margin-bottom: 15px">Edit Category</h2>
    <div class="container">
        <form action="{{ route('subcategories.update', $subCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">اسم الفئة الفرعية</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subCategory->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">الفئة الرئيسية</label>
                <select class="form-select" name="category_id" id="category_id" required>
                    <option value="">اختر فئة رئيسية</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea class="form-control" id="description" name="description">{{ $subCategory->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">تحديث الفئة الفرعية</button>
        </form>

    </div>
@endsection
