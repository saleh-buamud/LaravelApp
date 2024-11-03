@extends('dashboard.layout')

@section('content')
    <h1>إضافة منتج جديد</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="0"
                value="{{ old('quantity') }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01"
                value="{{ old('price') }}">
        </div>
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">الفئة الفرعية</label>
            <select class="form-select" name="sub_category_id" id="subcategory_id" required>
                <option value="">اختر فئة فرعية</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}"
                        {{ old('sub_category_id') == $subCategory->id ? 'selected' : '' }}>
                        {{ $subCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">الصورة</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">إضافة المنتج</button>
    </form>
@endsection
